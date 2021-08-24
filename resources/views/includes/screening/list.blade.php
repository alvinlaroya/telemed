<li class="{{ $item['class'] ?? '' }}">
    <input type="hidden" name="screenings[{{ $pkey }}]{{ isset($phkey) ? '['.$phkey.']' : '' }}{{ isset($ckey) ? '['.$ckey.']' : '' }}{{ isset($chkey) ? '['.$chkey.']' : '' }}[question]" value="{{ $item['question'] }}">
    <span class="list-title">{{ $item['question'] }}</span>
    @if($item['type'] == 'radio')
        <div class="my-3 form-check-inline">
            @foreach($item['options'] as $optkey => $option)
                <div class="custom-control custom-radio form-check-input">
                    <input id="{{ $optkey }}" name="screenings[{{ $pkey }}]{{ isset($phkey) ? '['.$phkey.']' : '' }}{{ isset($ckey) ? '['.$ckey.']' : '' }}{{ isset($chkey) ? '['.$chkey.']' : '' }}[value][{{ $option['name'] }}]" type="radio" class="custom-control-input" value="{{ $option['value'] }}">
                    <label class="custom-control-label" for="{{ $optkey }}">{{ $option['label'] }}</label>
                </div>
            @endforeach
        </div>
    @endif
    @if(isset($item['desc']))
        {!! $item['desc'] !!}
    @endif
    @if($item['type'] == 'nested')
        @if(isset($item['children']) && count((array)$item['children']) > 0)
            <ul>
                @foreach($item['children'] as $ckey => $item)
                    {{$ckey }}
                    @include('includes.screening.list', array_merge($item, array('parent' => false)))
                    @if(isset($item['hidden']))
                        <div class="{{ $item['hidden']['id'] ?? '' }}" id="{{ $item['hidden']['id'] ?? '' }}">
                            @if(isset($item['hidden']['items']) && count((array)$item['hidden']['items']) > 0)
                                <ol>
                                    @foreach($item['hidden']['items'] as $chkey => $item)
                                        {{ $chkey }}
                                        @include('includes.screening.list', array_merge($item, array('parent' => false)))
                                    @endforeach
                                </ol>
                            @endif
                        </div>
                    @endif
                @endforeach
            </ul>
        @endif
    @endif
    @if(isset($item['hidden']) && isset($parent) && $parent == true)
        <div class="{{ $item['hidden']['id'] ?? '' }}" id="{{ $item['hidden']['id'] ?? '' }}">
            @if(isset($item['hidden']['items']) && count((array)$item['hidden']['items']) > 0)
                <ol>
                    @foreach($item['hidden']['items'] as $phkey => $item)
                        {{ $phkey }}
                        @include('includes.screening.list', array_merge($item, array('parent' => false)))
                    @endforeach
                </ol>
            @endif
        </div>
    @endif
</li>
