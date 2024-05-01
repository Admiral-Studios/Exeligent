<?php

namespace App\Traits;


trait FormReassignable
{

    /**
     * Replace DB attribute values by INPUT
     * Taking attributes that may be reassigned from $reassignable variable
     *
     * @return void
     */
    public function reassign() {
        foreach ($this->reassignable as $attribute => $unset_count) {
            if (is_array($this->$attribute)) {
                $this->$attribute = $this->getReassignedItems($attribute, $unset_count);
            }
        }
    }


    /**
     * Returns new items for attribute in model with replacing DB values by INPUT and removes N-count of items
     *
     * @param string $attribute
     * @param int $unset_count
     * @return array
     */
    private function getReassignedItems(string $attribute, int $unset_count = 0): array
    {
        $new = [];
        foreach ($this->$attribute as $key => $value) {
            $reassigned_items = [];
            if (isset($this->$attribute[$key]) && is_array($this->$attribute[$key])) { // get all existing values from db
                $reassigned_items = $this->$attribute[$key];
            }
            if (is_array(old("$attribute.$key"))) { // replace db values by input values
                $reassigned_items = array_replace_recursive($reassigned_items, old("$attribute.$key"));
            }

            if ($unset_count > 0) {
                for ($i = 0; $i < $unset_count; $i++) {
                    if (isset($reassigned_items[$i])) { // remove item bcs its pre-rendered in view
                        unset($reassigned_items[$i]);
                    }
                }
            }

            $new[$key] = $this->$attribute[$key];
            $new[$key]['reassigned_items'] = $reassigned_items;
        }

        return $new;
    }

}
