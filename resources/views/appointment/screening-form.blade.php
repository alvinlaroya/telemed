@php
    $screeningArray = array(
        // Questions 1-3
        1 => array(
            'question' => 'Respiratory symptoms',
            'desc' => '<ul>
                        <li>Cough</li>
                        <li>Shortness of breath</li>
                        <li>Colds</li>
                        <li>Throat pain</li>
                        <li>Other respiratory symptoms</li>
                    </ul>',
            'type' => 'radio',
            'options' => array(
                'respiYes' => array(
                    'name' => 'respiratory',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'respiNo' => array(
                    'name' => 'respiratory',
                    'label' => 'No',
                    'value' => '0'
                ),
            )
        ),
        2 => array(
            'question' => 'Fever more than 38C',
            'type' => 'radio',
            'options' => array(
                'feverYes' => array(
                    'name' => 'fever',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'feverNo' => array(
                    'name' => 'fever',
                    'label' => 'No',
                    'value' => '0'
                ),
            )
        ),
        3 => array(
            'question' => 'Influenza-like illness',
            'desc' => '<ul style="margin-bottom: 10px;">
                        <li>Headache</li>
                        <li>Body pains/muscle pains</li>
                        <li>Gastroenteritis</li>
                        <li>Weakness</li>
                        <li>Lack of smell or taste</li>
                    </ul>',
            'type' => 'radio',
            'options' => array(
                'influenzaYes' => array(
                    'name' => 'influenza',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'influenzaNo' => array(
                    'name' => 'influenza',
                    'label' => 'No',
                    'value' => '0'
                ),
            )
        ),
        // Questions 4-6
        4 => array(
            'question' => 'Ever Tested for COVID-19',
            'type' => 'nested',
            'class' => 'question-4-6',
            'children' => array(
                1 => array(
                    'question' => 'Swab for RT PCR, if yes what was the result?',
                    'type' => 'radio',
                    'options' => array(
                        'swabRTPCRYes' => array(
                            'name' => 'swabRTPCR',
                            'label' => 'Positive',
                            'value' => '1'
                        ),
                        'swabRTPCRNo' => array(
                            'name' => 'swabRTPCR',
                            'label' => 'Negative',
                            'value' => '0'
                        ),
                    ),
                    'hidden' => array(
                        'id' => 'covid19-screening',
                        'items' => array(
                            1 => array(
                                'question' => 'For patients who had a positive rtPCR for COVID-19',
                                'type' => 'nested',
                                'children' => array(
                                    1 => array(
                                        'question' => 'Was a 14-day quarantine completed?',
                                        'type' => 'radio',
                                        'options' => array(
                                            'covidQYes' => array(
                                                'name' => 'covid19Quarantine',
                                                'label' => 'Yes',
                                                'value' => '1'
                                            ),
                                            'covidQNo' => array(
                                                'name' => 'covid19Quarantine',
                                                'label' => 'No',
                                                'value' => '0'
                                            ),
                                        )
                                    ),
                                    2 => array(
                                        'question' => 'Is there a negative PCR result after 14 days?',
                                        'type' => 'radio',
                                        'options' => array(
                                            'covidPCRYes' => array(
                                                'name' => 'covid19PCR',
                                                'label' => 'Yes',
                                                'value' => '1'
                                            ),
                                            'covidPCRNo' => array(
                                                'name' => 'covid19PCR',
                                                'label' => 'No',
                                                'value' => '0'
                                            ),
                                        )
                                    ),
                                    3 => array(
                                        'question' => 'Are there symptoms?',
                                        'type' => 'radio',
                                        'options' => array(
                                            'covidSymptomsYes' => array(
                                                'name' => 'covid19Symptoms',
                                                'label' => 'Yes',
                                                'value' => '1'
                                            ),
                                            'covidSymptomsNo' => array(
                                                'name' => 'covid19Symptoms',
                                                'label' => 'No',
                                                'value' => '0'
                                            ),
                                        )
                                    ),
                                )
                            ),
                            2 => array(
                                'question' => 'For patients who had an antibody testing result of positive to IgG or IgM but has not rtPCR result',
                                'type' => 'radio',
                                'options' => array(
                                    'antiBodyTestYes' => array(
                                        'name' => 'antiBodyTest',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'antiBodyTestNo' => array(
                                        'name' => 'antiBodyTest',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            )
                        )
                    )
                ),
                2 => array(
                    'question' => 'Rapid test kit for COVID-19, If yes, do you have your result with you?',
                    'type' => 'radio',
                    'options' => array(
                        'rapidTestYes' => array(
                            'name' => 'rapidTest',
                            'label' => 'Yes',
                            'value' => '1'
                        ),
                        'rapidTestNo' => array(
                            'name' => 'rapidTest',
                            'label' => 'No',
                            'value' => '0'
                        ),
                    )
                )
            )
        ),
        5 => array(
            'question' => 'Hospitalized for pneumonia',
            'class' => 'question-4-6',
            'type' => 'radio',
            'options' => array(
                'hospitalizedPneuYes' => array(
                    'name' => 'hospitalizedPneu',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'hospitalizedPneuNo' => array(
                    'name' => 'hospitalizedPneu',
                    'label' => 'No',
                    'value' => '0'
                ),
            ),
            'hidden' => array(
                'id' => 'hadPneumonia',
                'items' => array(
                    1 => array(
                        'question' => 'For patients who had pneumonia but had negative rtPCR to COVID-19',
                        'type' => 'nested',
                        'children' => array(
                            1 => array(
                                'question' => 'Was a 14-day quarantine completed?',
                                'type' => 'radio',
                                'options' => array(
                                    'pneumoniaQYes' => array(
                                        'name' => 'pneumoniaQuarantine',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'pneumoniaQNo' => array(
                                        'name' => 'pneumoniaQuarantine',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            ),
                            2 => array(
                                'question' => 'Is there a negative PCR result after 14 days?',
                                'type' => 'radio',
                                'options' => array(
                                    'pneumoniaPCRYes' => array(
                                        'name' => 'pneumoniaPCR',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'pneumoniaPCRYes' => array(
                                        'name' => 'pneumoniaPCR',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            ),
                            3 => array(
                                'question' => 'Are there symptoms?',
                                'type' => 'radio',
                                'options' => array(
                                    'pneumoniaSymptomsYes' => array(
                                        'name' => 'pneumoniaSymptoms',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'pneumoniaSymptomsNo' => array(
                                        'name' => 'pneumoniaSymptoms',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            ),
                        )
                    )
                )
            )
        ),
        6 => array(
            'question' => 'Hospitalized for COVID-19',
            'class' => 'question-4-6',
            'type' => 'radio',
            'options' => array(
                'hospitalizedCovidYes' => array(
                    'name' => 'hospitalizedCovid',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'hospitalizedCovidNo' => array(
                    'name' => 'hospitalizedCovid',
                    'label' => 'No',
                    'value' => '0'
                ),
            ),
            'hidden' => array(
                'id' => 'screening-4-6',
                'items' => array(
                    1 => array(
                        'question' => 'If positive for COVID-19 RTPCR',
                        'class' => 'posCovidRTPCR',
                        'type' => 'nested',
                        'children' => array(
                            1 => array(
                                'question' => 'Completed 14-day quarantine after resolution of symptoms or discharge from hospital',
                                'type' => 'radio',
                                'options' => array(
                                    'complete14DayQYes' => array(
                                        'name' => 'complete14DayQ',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'complete14DayQNo' => array(
                                        'name' => 'complete14DayQ',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            ),
                            2 => array(
                                'question' => 'Negative PCR result on or after Day 14 after 1st PCR test',
                                'type' => 'radio',
                                'options' => array(
                                    'negPCRResultsDay14Yes' => array(
                                        'name' => 'negPCRResultsDay14',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'negPCRResultsDay14No' => array(
                                        'name' => 'negPCRResultsDay14',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            ),
                            3 => array(
                                'question' => 'No respiratory symptoms or fever',
                                'type' => 'radio',
                                'options' => array(
                                    'noRespSympYes' => array(
                                        'name' => 'noRespSymp',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'noRespSympNo' => array(
                                        'name' => 'noRespSymp',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            ),
                        )
                    ),
                    2 => array(
                        'question' => 'If negative for COVID-19 RTPCR',
                        'class' => 'negCovidRTPCR',
                        'type' => 'nested',
                        'children' => array(
                            1 => array(
                                'question' => 'Completed 14-day quarantine after resolution of symptoms or discharge from hospital',
                                'type' => 'radio',
                                'options' => array(
                                    'negComplete14dayYes' => array(
                                        'name' => 'negComplete14day',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'negComplete14dayNo' => array(
                                        'name' => 'negComplete14day',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            ),
                            2 => array(
                                'question' => 'No respiratory symptoms or fever',
                                'type' => 'radio',
                                'options' => array(
                                    'negNoRespSympYes' => array(
                                        'name' => 'negNoRespSymp',
                                        'label' => 'Yes',
                                        'value' => '1'
                                    ),
                                    'negNoRespSympNo' => array(
                                        'name' => 'negNoRespSymp',
                                        'label' => 'No',
                                        'value' => '0'
                                    ),
                                )
                            ),
                        )
                    ),
                )
            )
        ),
        7 => array(
            'question' => 'Household member with cough, colds or throat pains',
            'class' => 'question-7-11',
            'type' => 'radio',
            'options' => array(
                'hhMemSickYes' => array(
                    'name' => 'hhMemSick',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'hhMemSickNo' => array(
                    'name' => 'hhMemSick',
                    'label' => 'No',
                    'value' => '0'
                ),
            ),
        ),
        8 => array(
            'question' => 'Household member diagnosed with COVID-19',
            'class' => 'question-7-11',
            'type' => 'radio',
            'options' => array(
                'hhMemDiagnosedYes' => array(
                    'name' => 'hhMemDiagnosed',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'hhMemDiagnosedNo' => array(
                    'name' => 'hhMemDiagnosed',
                    'label' => 'No',
                    'value' => '0'
                ),
            ),
        ),
        9 => array(
            'question' => 'Residence in an area reporting local transmission of COVID-19',
            'class' => 'question-7-11',
            'type' => 'radio',
            'options' => array(
                'residenceTransYes' => array(
                    'name' => 'residenceTrans',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'residenceTransNo' => array(
                    'name' => 'residenceTrans',
                    'label' => 'No',
                    'value' => '0'
                ),
            ),
        ),
        10 => array(
            'question' => 'Travelled abroad',
            'class' => 'question-7-11',
            'type' => 'radio',
            'options' => array(
                'travelledYes' => array(
                    'name' => 'travelled',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'travelledNo' => array(
                    'name' => 'travelled',
                    'label' => 'No',
                    'value' => '0'
                ),
            ),
        ),
        11 => array(
            'question' => 'Contact or exposure to someone with recent travel',
            'class' => 'question-7-11',
            'type' => 'radio',
            'options' => array(
                'exposureYes' => array(
                    'name' => 'exposure',
                    'label' => 'Yes',
                    'value' => '1'
                ),
                'exposureNo' => array(
                    'name' => 'exposure',
                    'label' => 'No',
                    'value' => '0'
                ),
            ),
        ),
    );
@endphp
<div class="text-center">
    <h2>Patient Screening Form</h2>
    <p class="lead">Patients who cannot be seen immediately in the clinic should be assessed by phone or by teleconsultation.</p>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <h5 class="mb-3">In the past two weeks did the patient have any of the following</h5>
        <form id="screeningForm" action="{{ route('save-patient-screening') }}" method="post">
            <div class="question-1-3">
                <ol>
                    {{-- @foreach ($screeningArray as $pkey => $item) --}}
                        @include('includes.screening.list-static')
                    {{-- @endforeach --}}
                </ol>
            </div>
        </form>
        <hr>    
        <div class="row">
            <div class="col-6">
                <button type="button" onClick="(function(){enableStep('step1')})()" 
                    class="btn btn-secondary btn-lg">
                    <span aria-hidden="true">&laquo;</span>
                    Back
                </button>
            </div>
            <div class="col-6">
                <div class="button-wrapper screeningButtons">
                    <input type="hidden" id="emergencyLink" value={{ route('emergencyNotice') }}>
                    <input type="hidden" id="appointmentLink" value={{ route('book-doctor') }}>
                    <button type="button" id="btn-ps" class="btn btn-primary btn-lg">
                        Next
                    </button>
                    <button type="button" id="btn-ps2" class="btn btn-primary btn-lg d-none">
                        Next
                    </button>
                    <button type="button" id="btn-ps3" class="btn btn-primary btn-lg d-none">
                        Next
                    </button>
                    {{-- <button class="btn btn-secondary btn-lg ml-2" id="backToForm" type="button">Back</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
