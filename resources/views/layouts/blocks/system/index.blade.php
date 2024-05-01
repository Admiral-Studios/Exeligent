@if($block->additional_content['view'] && view()->exists($block->additional_content['view']))
    @include($block->additional_content['view'])
@endif
