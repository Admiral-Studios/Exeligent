<?php

namespace App\Services;

use App\Enums\ContactGoalEnum;
use App\Enums\ContactStatusEnum;
use App\Models\UserNetworkingPreparation;

class NetworkingService
{

    const FUNNEL_PREFIX = 'funnel_';
    const CONTACTS_PREFIX = 'contacts_';

    final public function getFunnelQuery()
    {
        return \Auth::user()
            ->contacts()
            ->when(request(self::FUNNEL_PREFIX . 'search'), function ($q) {
                $q->search(request(self::FUNNEL_PREFIX . 'search'));
            })
            ->when(request(self::FUNNEL_PREFIX . 'goal'), function ($q) {
                $q->whereGoal(request(self::FUNNEL_PREFIX . 'goal'));
            })
            ->when(request(self::FUNNEL_PREFIX . 'role'), function ($q) {
                $q->where('position', 'LIKE', '%'.request(self::FUNNEL_PREFIX . 'role').'%');
            })
            ->when(request(self::FUNNEL_PREFIX . 'sort'), function ($q) {
                [$column, $direction] = explode(':', request(self::FUNNEL_PREFIX . 'sort'));
                $q->orderBy($column, $direction);
            });
    }

    final public function getFunnel()
    {
        return $this->getFunnelQuery()
            ->when(request(self::FUNNEL_PREFIX . 'status'), function ($q) {
                $q->whereStatus(request(self::FUNNEL_PREFIX . 'status'));
            })
            ->paginate(pageName: self::FUNNEL_PREFIX . 'page')
            ->withQueryString();
    }

    final public function getFunnelCounts(): array
    {
        return [
            'all' => $this->getFunnelQuery()->count(),
            ContactStatusEnum::NOT_CONTACTED->value => $this->getFunnelQuery()->whereStatus(ContactStatusEnum::NOT_CONTACTED)->count(),
            ContactStatusEnum::TO_CONTACT->value => $this->getFunnelQuery()->whereStatus(ContactStatusEnum::TO_CONTACT)->count(),
            ContactStatusEnum::TO_FOLLOW_UP->value => $this->getFunnelQuery()->whereStatus(ContactStatusEnum::TO_FOLLOW_UP)->count(),
            ContactStatusEnum::MEETING_SCHEDULED->value => $this->getFunnelQuery()->whereStatus(ContactStatusEnum::MEETING_SCHEDULED)->count(),
            ContactStatusEnum::NOT_RESPONDED_YET->value => $this->getFunnelQuery()->whereStatus(ContactStatusEnum::NOT_RESPONDED_YET)->count(),
        ];
    }

    final public function getUserPreparation(): UserNetworkingPreparation
    {
        return \Auth::user()->networkingPreparation()->firstOrCreate([], [
            'goals' => [],
            'helps' => [],
        ]);
    }

    final public function getContacts()
    {
        return \Auth::user()
            ->contacts()
            ->when(request(self::CONTACTS_PREFIX . 'search'), function ($q) {
                $q->search(request(self::CONTACTS_PREFIX . 'search'));
            })
            ->when(request(self::CONTACTS_PREFIX . 'location'), function ($q) {
                $q->where('location', 'LIKE', '%'.request(self::CONTACTS_PREFIX . 'location').'%');
            })
            ->when(request(self::CONTACTS_PREFIX . 'sort'), function ($q) {
                [$column, $direction] = explode(':', request(self::CONTACTS_PREFIX . 'sort'));
                $q->orderBy($column, $direction);
            })
            ->paginate(pageName: self::CONTACTS_PREFIX . 'page')
            ->withQueryString();
    }

    final public function getFilters(): array
    {
        $roles = [];
        foreach (\Auth::user()->contacts()->hasPosition()->pluck('position')->unique() as $position)
            $roles[$position] = $position;

        $goals = [];
        foreach (ContactGoalEnum::cases() as $case)
            $goals[$case->value] = $case->getTitle();

        $locations = [];
        foreach (\Auth::user()->contacts()->hasLocation()->pluck('location')->unique() as $location)
            $locations[$location] = $location;

        return [
            'funnel' => [
                'roles' => $roles,
                'goals' => $goals,
                'sort' => [
                    'contacted_at:DESC' => 'Latest contacted',
                    'contacted_at:ASC' => 'Oldest contacted',
                    'created_at:DESC' => 'New added first',
                    'created_at:ASC' => 'Oldest',
                ]
            ],
            'contacts' => [
                'locations' => $locations,
                'sort' => [
                    'relationship:DESC' => 'Best Relationship',
                    'relationship:ASC' => 'Worst Relationship',
                    'status:DESC' => 'Best Status',
                    'status:ASC' => 'Worst Status',
                ]
            ]
        ];
    }

}
