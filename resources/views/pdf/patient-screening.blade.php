<!DOCTYPE html>
<html>
    <head>
        <title>{{ $patient->first_name." ".$patient->last_name }} Screening</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        @include('pdf.style.screening-style')
    </head>
    <body>
        <div class="header-table">
            <table width="100%">
                <tr>
                    <td width="100%" class="header-left">
                        <img class="header-logo" src="{{ asset('images/logo.jpg')}}" style="max-width:100%" alt="ABC Hospital">
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="wrapper" style="font-size:16px">
            <h3 style="margin-bottom:0;padding:15px 0 0 15px;text-align:center">{{ (isset($type) && $type == 'fallrisk') || (request()->has('type') && request('type') == 'fallrisk') ? 'Fall Risk Form' : 'Screening Form' }}</h3>
            <div class="patient-info">
                <p><label>Patient Name:</label> <span style="width:645px">{{ $patient->name }}</span></p>
                <p><label>Birthday:</label> <span style="width:680px">{{ date('M-d-Y', strtotime($patient->birthdate)) }}</span></p>
            </div>

            <h5>Questions:</h5>
            @if((isset($type) && $type == 'booking') || (request()->has('type') && request('type') == 'booking'))
                @if(count($screening) > 0)
                <table class="questions-table">
                    <tbody>
                        @foreach($screening as $key => $item)
                            <tr>
                                <td>
                                    <span class="count">{{ $key + 1 }}.</span>
                                    {{ $item['question'] }}
                                    @if(isset($item['desc']))
                                        {!! $item['desc'] !!}
                                    @endif
                                </td>
                                <td>
                                    <b>
                                        <input type="checkbox" style="display:inline-block;margin-bottom:0;padding-top:2px" {{ isset($item['answer']) && $item['answer'] == 'yes' ? 'checked' : '' }}>
                                        <span style="display:inline-block;padding-bottom:2px">YES</span>
                                    </b>
                                </td>
                                <td>
                                    <b>
                                        <input type="checkbox" style="display:inline-block;margin-bottom:0;padding-top:2px"  {{ isset($item['answer']) && $item['answer'] == 'no' ? 'checked' : '' }}>
                                        <span style="display:inline-block;padding-bottom:2px">NO</span>
                                    </b>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            @elseif((isset($type) && $type == 'fallrisk') || (request()->has('type') && request('type') == 'fallrisk'))
                @if(count($fallrisk) > 0)
                <table class="questions-table">
                    <tbody>
                        @foreach($fallrisk as $key => $item)
                            <tr>
                                <td>
                                    <span class="count">{{ $key + 1 }}.</span>
                                    {{ $item['question'] }}
                                    @if(isset($item['desc']))
                                        {!! $item['desc'] !!}
                                    @endif
                                </td>
                                <td>
                                    <b>
                                        <input type="checkbox" style="display:inline-block;margin-bottom:0;padding-top:2px" {{ isset($item['answer']) && $item['answer'] == 'yes' ? 'checked' : '' }}>
                                        <span style="display:inline-block;padding-bottom:2px">YES</span>
                                    </b>
                                </td>
                                <td>
                                    <b>
                                        <input type="checkbox" style="display:inline-block;margin-bottom:0;padding-top:2px"  {{ isset($item['answer']) && $item['answer'] == 'no' ? 'checked' : '' }}>
                                        <span style="display:inline-block;padding-bottom:2px">NO</span>
                                    </b>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            @else
                @if(count($screening) > 0)
                    <ol>
                        @foreach($screening as $key => $item)
                            <li style="margin-bottom:12px;page-break-after:auto">
                                <p style="margin:0">{{ $item['question'] }}</p>
                                @if(isset($item['desc']))
                                    <div style="margin:8px 0">{!! $item['desc'] !!}</div>
                                @endif
                                @if(isset($item['answer']))
                                <p class="answer" style="margin:0">Answer: <span>{{ ucwords($item['answer']) }}</span></p>
                                @endif
                                {{-- First Child --}}
                                @if($item['type'] == 'nested')
                                    @if(isset($item['children']) && count((array)$item['children']) > 0)
                                        <ul style="margin-top:12px">
                                            @foreach($item['children'] as $key => $childItem)
                                                <li style="margin-bottom:12px">
                                                    <p style="margin:0">{{ $childItem['question'] }}</p>
                                                    @if(isset($childItem['answer']))
                                                        <p class="answer" style="margin:0">Answer: <span>{{ ucwords($childItem['answer']) }}</span></p>
                                                    @endif
                                                    {{-- Second Child --}}
                                                    @if($childItem['type'] == 'nested')
                                                        @if(isset($childItem['children']) && count((array)$childItem['children']) > 0)
                                                            <ol style="margin-top:12px">
                                                                @foreach($childItem['children'] as $key => $cchildItem)
                                                                    <li style="margin-bottom:12px;page-break-inside:avoid">
                                                                        <p style="margin:0">{{ $cchildItem['question'] }}</p>
                                                                        @if(isset($cchildItem['answer']))
                                                                            <p class="answer" style="margin:0">Answer: <span>{{ ucwords($cchildItem['answer']) }}</span></p>
                                                                        @endif
                                                                        {{-- Third Child --}}
                                                                        @if($cchildItem['type'] == 'nested')
                                                                            @if(isset($cchildItem['children']) && count((array)$cchildItem['children']) > 0)
                                                                                <ul style="margin-top:12px">
                                                                                    @foreach($cchildItem['children'] as $key => $ccchildItem)
                                                                                        <li style="margin-bottom:12px">
                                                                                            <p style="margin:0">{{ $ccchildItem['question'] }}</p>
                                                                                            @if(isset($ccchildItem['answer']))
                                                                                                <p class="answer" style="margin:0">Answer: <span>{{ ucwords($ccchildItem['answer']) }}</span></p>
                                                                                            @endif
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        @endif
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @endif
            @endif

            <div class="screening-info">
                <p><label>Screened by:</label> <span>Telemedicine Web App</span></p>
                @if(isset($datetime))
                <p><label>Date & Time:</label> <span>{{ date('M-d-Y h:ia', strtotime($datetime)) }}</span></p>
                @endif
            </div>
        </div>
    </body>
</html>
