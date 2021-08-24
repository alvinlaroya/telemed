<li><span class="list-title">Respiratory symptoms</span>
    <input type="hidden" name="screening[0][question]" value="Respiratory symptoms">
    <input type="hidden" name="screening[0][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="respiYes" name="screening[0][answer][respiratory]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="respiYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="respiNo" name="screening[0][answer][respiratory]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="respiNo">No</label>
        </div>
    </div>
    <ul>
        <li>Cough</li>
        <li>Shortness of breath</li>
        <li>Colds</li>
        <li>Throat pain</li>
        <li>Other respiratory symptoms</li>
    </ul>
</li>
<li><span class="list-title">Fever more than 38°C</span>
    <input type="hidden" name="screening[1][question]" value="Fever more than 38°C">
    <input type="hidden" name="screening[1][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="feverYes" name="screening[1][answer][fever]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="feverYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="feverNo" name="screening[1][answer][fever]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="feverNo">No</label>
        </div>
    </div>
</li>
<li><span class="list-title">Influenza-like illness</span>
    <input type="hidden" name="screening[2][question]" value="Influenza-like illness">
    <input type="hidden" name="screening[2][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="influenzaYes" name="screening[2][answer][influenza]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="influenzaYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="influenzaNo" name="screening[2][answer][influenza]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="influenzaNo">No</label>
        </div>
    </div>
    <ul style="margin-bottom: 10px;">
        <li>Headache</li>
        <li>Body pains/muscle pains</li>
        <li>Diarrhea/Vomiting</li>
        <li>Weakness</li>
        <li>Lack of smell or taste</li>
    </ul>
</li>
{{-- QUESTION 4 TO 6 --}}
<li class="question-4-6"><span class="list-title">Ever Tested for COVID-19 </span>
    <input type="hidden" name="screening[3][question]" value="Ever Tested for COVID-19">
    <input type="hidden" name="screening[3][type]" value="nested">
    <ul>
        <li><span class="list-title">Swab for RT PCR, if yes what was the result?</span>
            <input type="hidden" name="screening[3][children][0][question]" value="Swab for RT PCR, if yes what was the result?">
            <input type="hidden" name="screening[3][children][0][type]" value="nested">
            <div class="my-3 form-check-inline">
                <div class="custom-control custom-radio form-check-input">
                    <input id="swabRTPCRYes" name="screening[3][children][0][answer][swabRTPCR]" type="radio" class="custom-control-input" value="p" required>
                    <label class="custom-control-label" for="swabRTPCRYes">Positive</label>
                </div>
                <div class="custom-control custom-radio form-check-input">
                    <input id="swabRTPCRNo" name="screening[3][children][0][answer][swabRTPCR]" type="radio" class="custom-control-input" value="n" required>
                    <label class="custom-control-label" for="swabRTPCRNo">Negative</label>
                </div>
            </div>
        </li>
        <div class="covid19-screening" id="covid19-screening">
            <ol>
                <li>For patients who had a positive rtPCR for COVID-19
                    <input type="hidden" name="screening[3][children][0][children][0][question]" value="For patients who had a positive rtPCR for COVID-19">
                    <input type="hidden" name="screening[3][children][0][children][0][type]" value="nested">
                    <ul>
                        <li><span class="list-title">Was a 14-day quarantine completed?</span>
                            <input type="hidden" name="screening[3][children][0][children][0][children][0][question]" value="Was a 14-day quarantine completed?">
                            <input type="hidden" name="screening[3][children][0][children][0][children][0][type]" value="radio">
                            <div class="my-3 form-check-inline">
                                <div class="custom-control custom-radio form-check-input">
                                    <input id="covidQYes" name="screening[3][children][0][children][0][children][0][answer][covid19Quarantine]" type="radio" class="custom-control-input" value="1" required>
                                    <label class="custom-control-label" for="covidQYes">Yes</label>
                                </div>
                                <div class="custom-control custom-radio form-check-input">
                                    <input id="covidQNo" name="screening[3][children][0][children][0][children][0][answer][covid19Quarantine]" type="radio" class="custom-control-input" value="0" required>
                                    <label class="custom-control-label" for="covidQNo">No</label>
                                </div>
                            </div>
                        </li>
                        <li><span class="list-title">Is there a negative PCR result after 14 days?</span>
                            <input type="hidden" name="screening[3][children][0][children][0][children][1][question]" value="Is there a negative PCR result after 14 days?">
                            <input type="hidden" name="screening[3][children][0][children][0][children][1][type]" value="radio">
                            <div class="my-3 form-check-inline">
                                <div class="custom-control custom-radio form-check-input">
                                    <input id="covidPCRYes" name="screening[3][children][0][children][0][children][1][answer][covid19PCR]" type="radio" class="custom-control-input" value="1" required>
                                    <label class="custom-control-label" for="covidPCRYes">Yes</label>
                                </div>
                                <div class="custom-control custom-radio form-check-input">
                                    <input id="covidPCRNo" name="screening[3][children][0][children][0][children][1][answer][covid19PCR]" type="radio" class="custom-control-input" value="0" required>
                                    <label class="custom-control-label" for="covidPCRNo">No</label>
                                </div>
                            </div>
                        </li>
                        <li><span class="list-title">Are there symptoms? </span>
                            <input type="hidden" name="screening[3][children][0][children][0][children][2][question]" value="Are there symptoms?">
                            <input type="hidden" name="screening[3][children][0][children][0][children][2][type]" value="radio">
                            <div class="my-3 form-check-inline">
                                <div class="custom-control custom-radio form-check-input">
                                    <input id="covidSymptomsYes" name="screening[3][children][0][children][0][children][2][answer][covid19Symptoms]" type="radio" class="custom-control-input" value="1" required>
                                    <label class="custom-control-label" for="covidSymptomsYes">Yes</label>
                                </div>
                                <div class="custom-control custom-radio form-check-input">
                                    <input id="covidSymptomsNo" name="screening[3][children][0][children][0][children][2][answer][covid19Symptoms]" type="radio" class="custom-control-input" value="0" required>
                                    <label class="custom-control-label" for="covidSymptomsNo">No</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="antiBodyTest" id="antiBodyTest"><span class="list-title">For patients who had an antibody testing result of positive to IgG or IgM but has not rtPCR result</span>
                    <input type="hidden" name="screening[3][children][0][children][1][question]" value="For patients who had an antibody testing result of positive to IgG or IgM but has not rtPCR result">
                    <input type="hidden" name="screening[3][children][0][children][1][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="antiBodyTestYes" name="screening[3][children][0][children][1][answer][antiBodyTest]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="antiBodyTestYes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="antiBodyTestNo" name="screening[3][children][0][children][1][answer][antiBodyTest]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="antiBodyTestNo">No</label>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
        <li><span class="list-title">Rapid test kit for COVID-19, If yes, do you have your result with you?</span>
            <input type="hidden" name="screening[3][children][1][question]" value="Rapid test kit for COVID-19, If yes, do you have your result with you?">
            <input type="hidden" name="screening[3][children][1][type]" value="radio">
            <div class="my-3 form-check-inline">
                <div class="custom-control custom-radio form-check-input">
                    <input id="rapidTestYes" name="screening[3][children][1][answer][rapidTest]" type="radio" class="custom-control-input" value="1" required>
                    <label class="custom-control-label" for="rapidTestYes">Yes</label>
                </div>
                <div class="custom-control custom-radio form-check-input">
                    <input id="rapidTestNo" name="screening[3][children][1][answer][rapidTest]" type="radio" class="custom-control-input" value="0" required>
                    <label class="custom-control-label" for="rapidTestNo">No</label>
                </div>
            </div>
        </li>
    </ul>
</li>
<li class="question-4-6"><span class="list-title">Hospitalized for pneumonia</span>
    <input type="hidden" name="screening[4][question]" value="Hospitalized for pneumonia">
    <input type="hidden" name="screening[4][type]" value="nested">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="hospitalizedPneuYes" name="screening[4][answer][hospitalizedPneu]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="hospitalizedPneuYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="hospitalizedPneuNo" name="screening[4][answer][hospitalizedPneu]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="hospitalizedPneuNo">No</label>
        </div>
    </div>
</li>
<div class="hadPneumonia" id="hadPneumonia">
    <ol>
        <li>For patients who had pneumonia but had negative rtPCR to COVID-19
            <input type="hidden" name="screening[4][children][0][question]" value="For patients who had pneumonia but had negative rtPCR to COVID-19">
            <input type="hidden" name="screening[4][children][0][type]" value="nested">
            <ul>
                <li><span class="list-title">Was a 14-day quarantine completed?</span>
                    <input type="hidden" name="screening[4][children][0][children][0][question]" value="Was a 14-day quarantine completed?">
                    <input type="hidden" name="screening[4][children][0][children][0][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="pneumoniaQYes" name="screening[4][children][0][children][0][answer][pneumoniaQuarantine]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="pneumoniaQYes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="pneumoniaQNo" name="screening[4][children][0][children][0][answer][pneumoniaQuarantine]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="pneumoniaQNo">No</label>
                        </div>
                    </div>
                </li>
                <li><span class="list-title">Is there a negative PCR result after 14 days?</span>
                    <input type="hidden" name="screening[4][children][0][children][1][question]" value="Is there a negative PCR result after 14 days?">
                    <input type="hidden" name="screening[4][children][0][children][1][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="pneumoniaPCRYes" name="screening[4][children][0][children][1][answer][pneumoniaPCR]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="pneumoniaPCRYes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="pneumoniaPCRNo" name="screening[4][children][0][children][1][answer][pneumoniaPCR]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="pneumoniaPCRNo">No</label>
                        </div>
                    </div>
                </li>
                <li><span class="list-title">Are there symptoms? </span>
                    <input type="hidden" name="screening[4][children][0][children][2][question]" value="Are there symptoms?">
                    <input type="hidden" name="screening[4][children][0][children][2][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="pneumoniaSymptomsYes" name="screening[4][children][0][children][2][answer][pneumoniaSymptoms]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="pneumoniaSymptomsYes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="pneumoniaSymptomsNo" name="screening[4][children][0][children][2][answer][pneumoniaSymptoms]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="pneumoniaSymptomsNo">No</label>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
    </ol>
</div>
<li class="question-4-6"><span class="list-title">Hospitalized for COVID-19</span>
    <input type="hidden" name="screening[5][question]" value="Hospitalized for COVID-19">
    <input type="hidden" name="screening[5][type]" value="nested">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="hospitalizedCovidYes" name="screening[5][answer][hospitalizedCovid]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="hospitalizedCovidYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="hospitalizedCovidNo" name="screening[5][answer][hospitalizedCovid]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="hospitalizedCovidNo">No</label>
        </div>
    </div>
</li>
<div class="screening-4-6" id="screening-4-6">
    <ol>
        <li class="posCovidRTPCR" id="posCovidRTPCR"><span class="list-title">If positive for COVID-19 RTPCR</span>
            <input type="hidden" name="screening[5][children][0][question]" value="If positive for COVID-19 RTPCR">
            <input type="hidden" name="screening[5][children][0][type]" value="nested">
            <ul style="margin-bottom: 10px;">
                <li class="complete14DayQ" id="complete14DayQ"><span class="list-title">Completed 14-day quarantine after resolution of symptoms or discharge from hospital</span>
                    <input type="hidden" name="screening[5][children][0][children][0][question]" value="Completed 14-day quarantine after resolution of symptoms or discharge from hospital">
                    <input type="hidden" name="screening[5][children][0][children][0][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="complete14DayQYes" name="screening[5][children][0][children][0][answer][complete14DayQ]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="complete14DayQYes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="complete14DayQNo" name="screening[5][children][0][children][0][answer][complete14DayQ]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="complete14DayQNo">No</label>
                        </div>
                    </div>
                </li>
                <li><span class="list-title">Negative PCR result on or after Day 14 after 1st PCR test</span>
                    <input type="hidden" name="screening[5][children][0][children][1][question]" value="Negative PCR result on or after Day 14 after 1st PCR test">
                    <input type="hidden" name="screening[5][children][0][children][1][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="negPCRResultsDay14Yes" name="screening[5][children][0][children][1][answer][negPCRResultsDay14]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="negPCRResultsDay14Yes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="negPCRResultsDay14No" name="screening[5][children][0][children][1][answer][negPCRResultsDay14]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="negPCRResultsDay14No">No</label>
                        </div>
                    </div>
                </li>
                <li><span class="list-title">No respiratory symptoms or fever</span>
                    <input type="hidden" name="screening[5][children][0][children][2][question]" value="No respiratory symptoms or fever">
                    <input type="hidden" name="screening[5][children][0][children][2][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="noRespSympYes" name="screening[5][children][0][children][2][answer][noRespSymp]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="noRespSympYes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="noRespSympNo" name="screening[5][children][0][children][2][answer][noRespSymp]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="noRespSympNo">No</label>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <li class="negCovidRTPCR" id="negCovidRTPCR"><span class="list-title">If negative for COVID-19 RTPCR</span>
            <input type="hidden" name="screening[5][children][1][question]" value="If negative for COVID-19 RTPCR">
            <input type="hidden" name="screening[5][children][1][type]" value="nested">
            <ul>
                <li><span class="list-title">Completed 14-day quarantine after resolution of symptoms or discharge from hospital</span>
                    <input type="hidden" name="screening[5][children][1][children][0][question]" value="Completed 14-day quarantine after resolution of symptoms or discharge from hospital">
                    <input type="hidden" name="screening[5][children][1][children][0][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="negComplete14dayYes" name="screening[5][children][1][children][0][answer][negComplete14day]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="negComplete14dayYes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="negComplete14dayNo" name="screening[5][children][1][children][0][answer][negComplete14day]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="negComplete14dayNo">No</label>
                        </div>
                    </div>
                </li>
                <li><span class="list-title">No respiratory symptoms or fever</span>
                    <input type="hidden" name="screening[5][children][1][children][1][question]" value="No respiratory symptoms or fever">
                    <input type="hidden" name="screening[5][children][1][children][1][type]" value="radio">
                    <div class="my-3 form-check-inline">
                        <div class="custom-control custom-radio form-check-input">
                            <input id="negNoRespSympYes" name="screening[5][children][1][children][1][answer][negNoRespSymp]" type="radio" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="negNoRespSympYes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio form-check-input">
                            <input id="negNoRespSympNo" name="screening[5][children][1][children][1][answer][negNoRespSymp]" type="radio" class="custom-control-input" value="0" required>
                            <label class="custom-control-label" for="negNoRespSympNo">No</label>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
    </ol>
</div>
<li class="question-7-11"><span class="list-title">Household member with cough, colds or throat pains</span>
    <input type="hidden" name="screening[6][question]" value="Household member with cough, colds or throat pains">
    <input type="hidden" name="screening[6][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="hhMemSickYes" name="screening[6][answer][hhMemSick]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="hhMemSickYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="hhMemSickNo" name="screening[6][answer][hhMemSick]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="hhMemSickNo">No</label>
        </div>
    </div>
</li>
<li class="question-7-11"><span class="list-title">Household member diagnosed with COVID-19</span>
    <input type="hidden" name="screening[7][question]" value="Household member diagnosed with COVID-19">
    <input type="hidden" name="screening[7][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="hhMemDiagnosedYes" name="screening[7][answer][hhMemDiagnosed]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="hhMemDiagnosedYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="hhMemDiagnosedNo" name="screening[7][answer][hhMemDiagnosed]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="hhMemDiagnosedNo">No</label>
        </div>
    </div>
</li>
<li class="question-7-11"><span class="list-title">Residence in an area reporting local transmission of COVID-19</span>
    <input type="hidden" name="screening[8][question]" value="Residence in an area reporting local transmission of COVID-19">
    <input type="hidden" name="screening[8][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="residenceTransYes" name="screening[8][answer][residenceTrans]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="residenceTransYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="residenceTransNo" name="screening[8][answer][residenceTrans]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="residenceTransNo">No</label>
        </div>
    </div>
</li>
<li class="question-7-11"><span class="list-title">Travelled abroad</span>
    <input type="hidden" name="screening[9][question]" value="Travelled abroad">
    <input type="hidden" name="screening[9][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="travelledYes" name="screening[9][answer][travelled]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="travelledYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="travelledNo" name="screening[9][answer][travelled]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="travelledNo">No</label>
        </div>
    </div>
</li>
<li class="question-7-11"><span class="list-title">Contact or exposure to someone with recent travel</span>
    <input type="hidden" name="screening[10][question]" value="Contact or exposure to someone with recent travel">
    <input type="hidden" name="screening[10][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="exposureYes" name="screening[10][answer][exposure]" type="radio" class="custom-control-input" value="1" required>
            <label class="custom-control-label" for="exposureYes">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="exposureNo" name="screening[10][answer][exposure]" type="radio" class="custom-control-input" value="0" required>
            <label class="custom-control-label" for="exposureNo">No</label>
        </div>
    </div>
</li>
{{-- <div class="screening-7-11" id="screening-7-11">
    <ol>
        <li class="hasFeverResp" id="hasFeverResp"><span class="list-title">If patient has fever or respiratory symptoms, refer to ED for COVID-19 testing</span>
            <div class="my-3 form-check-inline">
                <div class="custom-control custom-radio form-check-input">
                    <input id="hasFeverRespYes" name="hasFeverResp" type="radio" class="custom-control-input" value="1" required>
                    <label class="custom-control-label" for="hasFeverRespYes">Yes</label>
                </div>
                <div class="custom-control custom-radio form-check-input">
                    <input id="hasFeverRespNo" name="hasFeverResp" type="radio" class="custom-control-input" value="0" checked required>
                    <label class="custom-control-label" for="hasFeverRespNo">No</label>
                </div>
            </div>
        </li>
        <li class="hasNoSymp" id="hasNoSymp"><span class="list-title">If patient has no respiratory symptoms, patient can only be seen in the clinic after completion of 14-day quarantine</span>
            <div class="my-3 form-check-inline">
                <div class="custom-control custom-radio form-check-input">
                    <input id="hasNoSympYes" name="hasNoSymp" type="radio" class="custom-control-input" value="1" required>
                    <label class="custom-control-label" for="hasNoSympYes">Yes</label>
                </div>
                <div class="custom-control custom-radio form-check-input">
                    <input id="hasNoSympNo" name="hasNoSymp" type="radio" class="custom-control-input" value="0" checked required>
                    <label class="custom-control-label" for="hasNoSympNo">No</label>
                </div>
            </div>
        </li>
    </ol>
</div> --}}
