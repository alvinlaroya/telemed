<li class="q1">
    <p class="question required">
        <span class="pr-2">Do you have any of the following symptoms within the past 14 days?</span>
        <input type="hidden" name="screening[patient][1][question]" value="Do you have any of the following symptoms within the past 14 days?">
        <span class="pr-2">
            <input type="radio" name="screening[patient][1][answer]" id="screening[patient][1][answer][yes]" value="Yes" required>
            <label for="screening[patient][1][answer][yes]">Yes</label>
        </span>
        <span class="pr-2">
            <input type="radio" name="screening[patient][1][answer]" id="screening[patient][1][answer][no]" value="No" required>
            <label for="screening[patient][1][answer][no]">No</label>
        </span>
    </p>
    <ul>
        <li>
            <p class="question q-block">
                <span class="pr-2">Respiratory Symptoms</span>
                <input type="hidden" name="screening[patient][1][child][1][question]" value="Respiratory Symptoms">
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][1][answer][]" id="screening[patient][1][child][1][answer][2]" value="Cough">
                    <label for="screening[patient][1][child][1][answer][2]">Cough</label>
                </span>
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][1][answer][]" id="screening[patient][1][child][1][answer][3]" value="Colds">
                    <label for="screening[patient][1][child][1][answer][3]">Colds</label>
                </span>
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][1][answer][]" id="screening[patient][1][child][1][answer][4]" value="Throat Pain">
                    <label for="screening[patient][1][child][1][answer][4]">Throat Pain</label>
                </span>
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][1][answer][]" id="screening[patient][1][child][1][answer][5]" value="Shortness of Breath">
                    <label for="screening[patient][1][child][1][answer][5]">Shortness of Breath</label>
                </span>
            </p>
        </li>
        <li style="display:none">
            <p class="question q-block">
                <span class="pr-2">Status of Respiratory Symptoms</span>
                <input type="hidden" name="screening[patient][1][child][2][question]" value="Status of Respiratory Symptoms">
                <span class="pr-2">
                    <input type="radio" name="screening[patient][1][child][2][answer]" id="screening[patient][1][child][2][answer][1]" value="Worsening">
                    <label for="screening[patient][1][child][2][answer][1]">Worsening</label>
                </span>
                <span class="pr-2">
                    <input type="radio" name="screening[patient][1][child][2][answer]" id="screening[patient][1][child][2][answer][2]" value="Stable/Improving">
                    <label for="screening[patient][1][child][2][answer][2]">Stable/Improving</label>
                </span>
            </p>
        </li>
        <li>
            <p class="question q-block">
                <span class="pr-2">Influenza-like Symptoms</span>
                <input type="hidden" name="screening[patient][1][child][3][question]" value="Influenza-like Symptoms">
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][3][answer][]" id="screening[patient][1][child][3][answer][2]" value="Headache">
                    <label for="screening[patient][1][child][3][answer][2]">Headache</label>
                </span>
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][3][answer][]" id="screening[patient][1][child][3][answer][3]" value="Body aches or muscle pains">
                    <label for="screening[patient][1][child][3][answer][3]">Body aches or muscle pains</label>
                </span>
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][3][answer][]" id="screening[patient][1][child][3][answer][4]" value="Diarrhea with or without Vomiting">
                    <label for="screening[patient][1][child][3][answer][4]">Diarrhea with or without Vomiting</label>
                </span>
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][3][answer][]" id="screening[patient][1][child][3][answer][5]" value="Weakness">
                    <label for="screening[patient][1][child][3][answer][5]">Weakness</label>
                </span>
                <span class="pr-2">
                    <input type="checkbox" name="screening[patient][1][child][3][answer][]" id="screening[patient][1][child][3][answer][6]" value="Lack of smell or taste">
                    <label for="screening[patient][1][child][3][answer][6]">Lack of smell or taste</label>
                </span>
            </p>
        </li>
        <li>
            <p class="question q-block">
                <span class="pr-2">Fever 38 degrees Celsius or higher</span>
                <input type="hidden" name="screening[patient][1][child][4][question]" value="Fever 38 degrees Celsius or higher">
                <span class="pr-2">
                    <input type="radio" name="screening[patient][1][child][4][answer]" id="screening[patient][1][child][4][answer][1]" value="Yes">
                    <label for="screening[patient][1][child][4][answer][1]">Yes</label>
                </span>
                <span class="pr-2">
                    <input type="radio" name="screening[patient][1][child][4][answer]" id="screening[patient][1][child][4][answer][2]" value="No">
                    <label for="screening[patient][1][child][4][answer][2]">No</label>
                </span>
            </p>
        </li>
    </ul>
</li>
<li class="q2 hidden" style="display:none">
    <p class="question required">
        <span class="pr-2">Did you have any unprotected close contact with a COVID-19 case?</span>
        <input type="hidden" name="screening[patient][2][question]" value="Do you have any unprotected close contact with a COVID-19 case?">
        <span class="pr-2">
            <input type="radio" name="screening[patient][2][answer]" id="screening[patient][2][answer][yes]" value="Yes" required>
            <label for="screening[patient][2][answer][yes]">Yes</label>
        </span>
        <span class="pr-2">
            <input type="radio" name="screening[patient][2][answer]" id="screening[patient][2][answer][no]" value="No" required>
            <label for="screening[patient][2][answer][no]">No</label>
        </span>
        <span class="desc">
            ***Unprotected close contact – being within approximately six (6) feet or two (2) meters of a person with COVID-19 for approximately five (5) minutes or longer and not wearing a face mask.
        </span>
    </p>
    <ul class="hidden" style="display:none">
        <li>
            <p class="question q-block">
                <span class="pr-2">Were you tested for COVID-19?</span>
                <input type="hidden" name="screening[patient][2][child][1][question]" value="Were you tested for COVID-19?">
                <span class="pr-2">
                    <input type="radio" name="screening[patient][2][child][1][answer]" id="screening[patient][2][child][1][answer][yes]" value="Yes">
                    <label for="screening[patient][2][child][1][answer][yes]">Yes</label>
                </span>
                <span class="pr-2">
                    <input type="radio" name="screening[patient][2][child][1][answer]" id="screening[patient][2][child][1][answer][no]" value="No">
                    <label for="screening[patient][2][child][1][answer][no]">No</label>
                </span>
            </p>
            <ul class="hidden" style="display:none">
                <li>
                    <p class="question q-block">
                        <span class="pr-2">Have you completed 14 days quarantine?</span>
                        <input type="hidden" name="screening[patient][2][child][1][child][1][question]" value="Have you completed 14 days quarantine?">
                        <span class="pr-2">
                            <input type="radio" name="screening[patient][2][child][1][child][1][answer]" id="screening[patient][2][child][1][child][1][answer][yes]" value="Yes">
                            <label for="screening[patient][2][child][1][child][1][answer][yes]">Yes</label>
                        </span>
                        <span class="pr-2">
                            <input type="radio" name="screening[patient][2][child][1][child][1][answer]" id="screening[patient][2][child][1][child][1][answer][no]" value="No">
                            <label for="screening[patient][2][child][1][child][1][answer][no]">No</label>
                        </span>
                    </p>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="q3 hidden" style="display:none">
    <p class="question required">
        <span class="pr-2">Have you been hospitalized for COVID-19 or pneumonia for the past month?</span>
        <input type="hidden" name="screening[patient][3][question]" value="Have you been hospitalized for COVID-19 or pneumonia for the past month?">
        <span class="pr-2">
            <input type="radio" name="screening[patient][3][answer]" id="screening[patient][3][answer][yes]" value="Yes" required>
            <label for="screening[patient][3][answer][yes]">Yes</label>
        </span>
        <span class="pr-2">
            <input type="radio" name="screening[patient][3][answer]" id="screening[patient][3][answer][no]" value="No" required>
            <label for="screening[patient][3][answer][no]">No</label>
        </span>
    </p>
    <ul class="hidden" style="display:none">
        <li>
            <p class="question q-block">
                <span class="pr-2">Have you completed 14 days quarantine?</span>
                <input type="hidden" name="screening[patient][3][child][1][question]" value="Have you completed 14 days quarantine?">
                <span class="pr-2">
                    <input type="radio" name="screening[patient][3][child][1][answer]" id="screening[patient][3][child][1][answer][yes]" value="Yes">
                    <label for="screening[patient][3][child][1][answer][yes]">Yes</label>
                </span>
                <span class="pr-2">
                    <input type="radio" name="screening[patient][3][child][1][answer]" id="screening[patient][3][child][1][answer][no]" value="No">
                    <label for="screening[patient][3][child][1][answer][no]">No</label>
                </span>
            </p>
        </li>
        <li>
            <p class="question q-block">
                <span class="pr-2">Do you have subsequent NEGATIVE RT-PCR result?</span>
                <input type="hidden" name="screening[patient][3][child][2][question]" value="Do you have subsequent NEGATIVE RT-PCR result?">
                <span class="pr-2">
                    <input type="radio" name="screening[patient][3][child][2][answer]" id="screening[patient][3][child][2][answer][yes]" value="Yes">
                    <label for="screening[patient][3][child][2][answer][yes]">Yes</label>
                </span>
                <span class="pr-2">
                    <input type="radio" name="screening[patient][3][child][2][answer]" id="screening[patient][3][child][2][answer][no]" value="No">
                    <label for="screening[patient][3][child][2][answer][no]">No</label>
                </span>
            </p>
        </li>
    </ul>
</li>
<li class="q4">
    <p class="question hidden required" style="display:none">
        <span class="pr-2">Have you been tested for COVID-19?</span>
        <input type="hidden" name="screening[patient][4][question]" value="Have you been tested for COVID-19?">
        <span class="pr-2">
            <input type="radio" name="screening[patient][4][answer]" id="screening[patient][4][answer][yes]" value="Yes" required>
            <label for="screening[patient][4][answer][yes]">Yes</label>
        </span>
        <span class="pr-2">
            <input type="radio" name="screening[patient][4][answer]" id="screening[patient][4][answer][no]" value="No" required>
            <label for="screening[patient][4][answer][no]">No</label>
        </span>
    </p>
    <ul class="hidden" style="display:none">
        <li>
            <p class="question q-block">
                <span class="pr-2">Have you had RT-PCR (Swab Test)?</span>
                <input type="hidden" name="screening[patient][4][child][1][question]" value="Have you had RT-PCR (Swab Test)?">
                <span class="pr-2">
                    <input type="radio" name="screening[patient][4][child][1][answer]" id="screening[patient][4][child][1][answer][yes]" value="Yes">
                    <label for="screening[patient][4][child][1][answer][yes]">Yes</label>
                </span>
                <span class="pr-2">
                    <input type="radio" name="screening[patient][4][child][1][answer]" id="screening[patient][4][child][1][answer][no]" value="No">
                    <label for="screening[patient][4][child][1][answer][no]">No</label>
                </span>
            </p>
            <ul class="hidden" style="display:none">
                <li>
                    <p class="question">
                        <span class="pr-2">If YES, enter date of swab test?</span>
                        <input type="hidden" name="screening[patient][4][child][1][child][1][question]" value="If YES, enter date of swab test?">
                        <input type="date" name="screening[patient][4][child][1][child][1][answer]" value="">
                    </p>
                </li>
                <li>
                    <p class="question q-block">
                        <span class="pr-2">If YES, result?</span>
                        <input type="hidden" name="screening[patient][4][child][1][child][2][question]" value="If YES, result?">
                        <span class="pr-2">
                            <input type="radio" name="screening[patient][4][child][1][child][2][answer]" id="screening[patient][4][child][1][child][2][answer][yes]" value="Positive">
                            <label for="screening[patient][4][child][1][child][2][answer][yes]">Positive</label>
                        </span>
                        <span class="pr-2">
                            <input type="radio" name="screening[patient][4][child][1][child][2][answer]" id="screening[patient][4][child][1][child][2][answer][no]" value="Negative">
                            <label for="screening[patient][4][child][1][child][2][answer][no]">Negative</label>
                        </span>
                    </p>
                    <ul class="hidden" style="display:none">
                        <li>
                            <p class="question q-block">
                                <span class="pr-2">Have you completed 14 days quarantine?</span>
                                <input type="hidden" name="screening[patient][4][child][1][child][2][child][1][question]" value="Have you completed 14 days quarantine?">
                                <span class="pr-2">
                                    <input type="radio" name="screening[patient][4][child][1][child][2][child][1][answer]" id="screening[patient][4][child][1][child][2][child][1][answer][yes]" value="Yes">
                                    <label for="screening[patient][4][child][1][child][2][child][1][answer][yes]">Yes</label>
                                </span>
                                <span class="pr-2">
                                    <input type="radio" name="screening[patient][4][child][1][child][2][child][1][answer]" id="screening[patient][4][child][1][child][2][child][1][answer][no]" value="No">
                                    <label for="screening[patient][4][child][1][child][2][child][1][answer][no]">No</label>
                                </span>
                            </p>
                        </li>
                        <li>
                            <p class="question q-block">
                                <span class="pr-2">Do you have subsequent RT-PCR Negative result?</span>
                                <input type="hidden" name="screening[patient][4][child][1][child][2][child][2][question]" value="Do you have subsequent RT-PCR Negative result?">
                                <span class="pr-2">
                                    <input type="radio" name="screening[patient][4][child][1][child][2][child][2][answer]" id="screening[patient][4][child][1][child][2][child][2][answer][yes]" value="Yes">
                                    <label for="screening[patient][4][child][1][child][2][child][2][answer][yes]">Yes</label>
                                </span>
                                <span class="pr-2">
                                    <input type="radio" name="screening[patient][4][child][1][child][2][child][2][answer]" id="screening[patient][4][child][1][child][2][child][2][answer][no]" value="No">
                                    <label for="screening[patient][4][child][1][child][2][child][2][answer][no]">No</label>
                                </span>
                            </p>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <p class="question q-block">
                <span class="pr-2">Have you had Rapid Antibody Test for COVID-19?</span>
                <input type="hidden" name="screening[patient][4][child][2][question]" value="Have you had Rapid Antibody Test for COVID-19?">
                <span class="pr-2">
                    <input type="radio" name="screening[patient][4][child][2][answer]" id="screening[patient][4][child][2][answer][yes]" value="Yes">
                    <label for="screening[patient][4][child][2][answer][yes]">Yes</label>
                </span>
                <span class="pr-2">
                    <input type="radio" name="screening[patient][4][child][2][answer]" id="screening[patient][4][child][2][answer][no]" value="No">
                    <label for="screening[patient][4][child][2][answer][no]">No</label>
                </span>
            </p>
            <ul class="hidden" style="display:none">
                <li>
                    <p class="question q-block">
                        <span class="pr-2">If YES, result?</span>
                        <input type="hidden" name="screening[patient][4][child][2][child][1][question]" value="If YES, result?">
                        <span class="pr-2">
                            <input type="radio" name="screening[patient][4][child][2][child][1][answer]" id="screening[patient][4][child][2][child][1][answer][yes]" value="Positive either IgG/IgM">
                            <label for="screening[patient][4][child][2][child][1][answer][yes]">Positive either IgG/IgM</label>
                        </span>
                        <span class="pr-2">
                            <input type="radio" name="screening[patient][4][child][2][child][1][answer]" id="screening[patient][4][child][2][child][1][answer][no]" value="Negative both IgG/IgM">
                            <label for="screening[patient][4][child][2][child][1][answer][no]">Negative both IgG/IgM</label>
                        </span>
                        <ul class="hidden" style="display:none">
                            <li>
                                <p class="question q-block">
                                    <span class="pr-2">Have you had RT-PCR Test (Swab Test)?</span>
                                    <input type="hidden" name="screening[patient][4][child][2][child][1][child][1][question]" value="Have you had RT-PCR Test (Swab Test)?">
                                    <span class="pr-2">
                                        <input type="radio" name="screening[patient][4][child][2][child][1][child][1][answer]" id="screening[patient][4][child][2][child][1][child][1][answer][yes]" value="Yes">
                                        <label for="screening[patient][4][child][2][child][1][child][1][answer][yes]">Yes</label>
                                    </span>
                                    <span class="pr-2">
                                        <input type="radio" name="screening[patient][4][child][2][child][1][child][1][answer]" id="screening[patient][4][child][2][child][1][child][1][answer][no]" value="No">
                                        <label for="screening[patient][4][child][2][child][1][child][1][answer][no]">No</label>
                                    </span>
                                </p>
                                <ul class="hidden" style="display:none">
                                    <li>
                                        <p class="question q-block">
                                            <span class="pr-2">Have you completed the 14 days quarantine?</span>
                                            <input type="hidden" name="screening[patient][4][child][2][child][1][child][1][child][1][question]" value="Have you completed the 14 days quarantine?">
                                            <span class="pr-2">
                                                <input type="radio" name="screening[patient][4][child][2][child][1][child][1][child][1][answer]" id="screening[patient][4][child][2][child][1][child][1][child][1][answer][yes]" value="Yes">
                                                <label for="screening[patient][4][child][2][child][1][child][1][child][1][answer][yes]">Yes</label>
                                            </span>
                                            <span class="pr-2">
                                                <input type="radio" name="screening[patient][4][child][2][child][1][child][1][child][1][answer]" id="screening[patient][4][child][2][child][1][child][1][child][1][answer][no]" value="No">
                                                <label for="screening[patient][4][child][2][child][1][child][1][child][1][answer][no]">No</label>
                                            </span>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                </li>
            </ul>
        </li>
    </ul>
</li>
