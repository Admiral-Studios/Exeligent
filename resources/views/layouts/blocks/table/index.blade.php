@if($block->additional_content->isNotEmpty())
    @php($table = $block->additional_content)
    <div class="section-dashboard section-dashboard-self" style="margin-top: 26px !important;">
        <div class="section-dashboard-content">
            <div class="e-mobile-table">
                <table class="e-table">
                    <thead>
                    <tr>
                        @foreach($table->shift() as $th)
                            <th>{{ $th }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $tr)
                        <tr>
                            @foreach($tr as $td)
                                <td>{{ $td }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endif
