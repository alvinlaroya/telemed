<!DOCTYPE html>
<html>
    <head>
        <title>{{ $patient->first_name." ".$patient->last_name }}'s Companion Screening</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        @include('pdf.style.screening-style-2')
    </head>
    <body>
        <div class="header-table">
            <table width="100%">
                <tr>
                    <td width="45%" class="header-left">
                        <img class="header-logo" src="{{ asset('images/logo.jpg')}}" style="max-width:250px" alt="ABC Hospital">
                    </td>
                    <td width="55%" class="header-right companion">
                        <h1 style="color:#888;font-size:14px">COMPANION’S HEALTH SCREENING FORM</h1>
                    </td>
                </tr>
            </table>
        </div>
        <div class="wrapper" style="font-size:11px">
            <p>ABC Hospital ensures the safety of its patients, visitors, employees, medical staff and the community<br> through COVID-19 related disease surveillance. ABC Hospital  upholds the implementation of patient and visitor’s data privacy<br> rights in accordance with the Data Privacy Act.</p>
            <p>Please fill-out the form and present the Patient Screening Report to your healthcare provider. Put a check (√) mark in<br> appropriate box.</p>
            <table class="table-patient-info">
                <tr>
                    <td width="70%">Companion’s full name: <span>{{ $screening['companion_details']['firstname'] ?? '' }} {{ $screening['companion_details']['lastname'] ?? '' }}</span></td>
                    <td width="30%">Date: <span>{{ isset($datetime) ? date('M-d-Y h:ia', strtotime($datetime)) : '' }}</span></td>
                </tr>
            </table>
            <table class="table-patient-info">
                <tr>
                    <td width="22%">Date of Birth: <span>{{ ($screening['companion_details']['birthdate'] ?? '') ? date('M-d-Y', strtotime($screening['companion_details']['birthdate'])) : '' }}</span></td>
                    <td width="33.33%">Patient's name: <span>{{ $patient->name }}</span></td>
                    <td width="33.33%">Contact number: <span>{{ $patient->mobile }}</span></td>
                </tr>
            </table>
            <div class="table-questions">
                <table class="table-question q1" style="margin-top: 6px;">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">Q1. DO YOU HAVE ANY OF THE FOLLOWING SYMPTOMS WITHIN THE PAST 14 DAYS?</span>
                                <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                    <img src="{{ whatBox(($screening['companion'][1]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                    <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                </b>
                                <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                    <img src="{{ whatBox(($screening['companion'][1]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                    <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO</span>
                                </b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="32%">
                                <strong>Respiratory symptoms</strong>
                                <ul class="checklist">
                                    <li>{!! in_array('Cough', ($screening['companion'][1]['child'][1]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Cough</li>
                                    <li>{!! in_array('Colds', ($screening['companion'][1]['child'][1]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Colds</li>
                                    <li>{!! in_array('Throat Pain', ($screening['companion'][1]['child'][1]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Throat pain</li>
                                    <li>{!! in_array('Shortness of Breath', ($screening['companion'][1]['child'][1]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Shortness of breath</li>
                                </ul>
                                <strong>Status of respiratory symptoms:</strong>
                                <ul class="checklist">
                                    <li>{!! ($screening['companion'][1]['child'][2]['answer'] ?? '') == 'Worsening' ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Worsening</li>
                                    <li>{!! ($screening['companion'][1]['child'][2]['answer'] ?? '') == 'Stable/Improving' ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Stable/Improving</li>
                                </ul>
                            </td>
                            <td width="50%">
                                <strong>Influenza-like symptoms</strong>
                                <ul class="checklist">
                                    <li>{!! in_array('Headache', ($screening['companion'][1]['child'][3]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Headache</li>
                                    <li>{!! in_array('Body pains or muscle pains', ($screening['companion'][1]['child'][3]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Body pains or muscle pains</li>
                                    <li>{!! in_array('Diarrhea with or without Vomiting', ($screening['companion'][1]['child'][3]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Diarrhea with or without Vomiting</li>
                                    <li>{!! in_array('Weakness', ($screening['companion'][1]['child'][3]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Weakness</li>
                                    <li>{!! in_array('Lack of smell or taste', ($screening['companion'][1]['child'][3]['answer'] ?? array())) ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Lack of smell or taste</li>
                                </ul>
                            </td>
                            <td width="15%">
                                <ul class="checklist">
                                    <li>{!! ($screening['companion'][1]['child'][4]['answer'] ?? '') == 'Yes' ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Fever 38 degrees Celsius or higher</li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table-question q2">
                    <thead>
                        <tr>
                            <th style="font-size:10.5px">
                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">Q2. DO YOU HAVE ANY UNPROTECTED CLOSE CONTACT WITH A COVID-19 CASE?</span>
                                <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                    <img src="{{ whatBox(($screening['companion'][2]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                    <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                </b>
                                <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                    <img src="{{ whatBox(($screening['companion'][2]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                    <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO <span style="font-weight:400">proceed to Q3</span></span>
                                </b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border-right:0">
                                <p style="margin-bottom:2px">Were you tested for COVID-19?</p>
                                <p class="option">
                                    <img src="{{ whatBox(($screening['companion'][2]['child'][1]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                    <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES, proceed to Q4</span>
                                </p>
                                <p class="option">
                                    <img src="{{ whatBox(($screening['companion'][2]['child'][1]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                    <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO, Have you completed 14 days quarantine?</span>
                                    <span>
                                        <span class="option">
                                            <img src="{{ whatBox(($screening['companion'][2]['child'][1]['child'][1]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                        </span>
                                        <span class="option">
                                            <img src="{{ whatBox(($screening['companion'][2]['child'][1]['child'][1]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO, may not proceed with next questions</span>
                                        </span>
                                    </span>
                                </p>
                                <p style="font-size:9px;margin:0;text-align:center">
                                    <em style="color:#222;line-height:1">***Unprotected close contact – being within approximately six (6) feet or two (2) meters of a person with COVID-19 for approximately five (5) minutes  or longer and not wearing a face mask.</em>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table-question q3">
                    <thead>
                        <tr>
                            <th colspan="2" style="font-size:10.5px">
                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">Q3. HAVE YOU BEEN HOSPITALIZED FOR COVID-19 OR PNEUMONIA FOR THE PAST MONTH?</span><br>
                                <span style="float:right;margin-top:4px">
                                    <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                        <img src="{{ whatBox(($screening['companion'][3]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                    </b>
                                    <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                        <img src="{{ whatBox(($screening['companion'][3]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO <span style="font-weight:400">proceed to Q4</span></span>
                                    </b>
                                </span>
                                <div style="clear:both"></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="50%" style="border-right:0">
                                <p style="margin-bottom:4px">
                                    <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">If YES: Have you completed 14 days quarantine?</span>
                                </p>
                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1;margin-left:38px">Do you have subsequent NEGATIVE RT-PCR result?</span>
                            </td>
                            <td width="50%">
                                <p style="margin-bottom:4px">
                                    <span>
                                        <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                            <img src="{{ whatBox(($screening['companion'][3]['child'][1]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                        </b>
                                        <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                            <img src="{{ whatBox(($screening['companion'][3]['child'][1]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO</span>
                                        </b>
                                    </span>
                                </p>
                                <span>
                                    <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                        <img src="{{ whatBox(($screening['companion'][3]['child'][2]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                    </b>
                                    <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                        <img src="{{ whatBox(($screening['companion'][3]['child'][2]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO</span>
                                    </b>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table-question q4">
                    <thead>
                        <tr>
                            <th colspan="2">
                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">Q4. HAVE YOU BEEN TESTED FOR COVID-19?</span>
                                <span>
                                    <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                        <img src="{{ whatBox(($screening['companion'][4]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                    </b>
                                    <b style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                        <img src="{{ whatBox(($screening['companion'][4]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO</span>
                                    </b>
                                </span>
                                <div style="clear:both"></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="45%">
                                <p style="margin-bottom:2px;line-height:1"><strong>Q4.1 Have you had RT-PCR (Swab Test)?</strong></p>
                                <span>
                                    <p class="option">
                                        <img src="{{ whatBox(($screening['companion'][4]['child'][1]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">No, proceed to Q4.2</span>
                                    </p>
                                    <p class="option" style="margin-bottom:0;line-height:1">
                                        <img src="{{ whatBox(($screening['companion'][4]['child'][1]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1;width:100%">Yes, date of swab test: 
                                            <span style="border-bottom:1px dashed #111;display:inline-block;padding-bottom:2px;vertical-align:middle;width:110px">{!! isset($screening['companion'][4]['child'][1]['child'][1]['answer']) ? date('M-d-Y', strtotime($screening['companion'][4]['child'][1]['child'][1]['answer'])) : '&nbsp;' !!}</span>
                                        </span>
                                    </p>
                                    <p style="margin-bottom:6px;margin-top:-4px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">swab test result:</span>
                                        <span>
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                                <img src="{{ whatBox(($screening['companion'][4]['child'][1]['child'][2]['answer'] ?? ''), 'Positive') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">Positive</span>
                                            </span>
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                                <img src="{{ whatBox(($screening['companion'][4]['child'][1]['child'][2]['answer'] ?? ''), 'Negative') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">Negative</span>
                                            </span>
                                        </span>
                                    </p>
                                </span>
                                <p style="margin-bottom:6px"><strong>If <u>POSITIVE RT-PCR</u>: </strong></p>
                                <span>
                                    <p style="margin-bottom:2px">Have you completed 14 days quarantine?</p>
                                    <span class="option" style="margin-left:24px">
                                        <img src="{{ whatBox(($screening['companion'][4]['child'][1]['child'][2]['child'][1]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                    </span>
                                    <span class="option">
                                        <img src="{{ whatBox(($screening['companion'][4]['child'][1]['child'][2]['child'][1]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO</span>
                                    </span>
                                </span>
                                <span>
                                    <p style="margin-bottom:2px">Do you have subsequent RT-PCR Negative result?</p>
                                    <span class="option" style="margin-left:24px">
                                        <img src="{{ whatBox(($screening['companion'][4]['child'][1]['child'][2]['child'][2]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                    </span>
                                    <span class="option">
                                        <img src="{{ whatBox(($screening['companion'][4]['child'][1]['child'][2]['child'][2]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO</span>
                                    </span>
                                </span>
                            </td>
                            <td width="55%">
                                <p style="margin-bottom:2px;line-height:1"><strong>Q4.2 Have you had Rapid Antibody Test for COVID-19?</strong></p>
                                <span style="display:block;margin-bottom:8px">
                                    <p class="option">
                                        <img src="{{ whatBox(($screening['companion'][4]['child'][2]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">No</span>
                                    </p>
                                    <p class="option" style="margin-bottom:0;line-height:1">
                                        <img src="{{ whatBox(($screening['companion'][4]['child'][2]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                        <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1;width:100%">Yes, Result: 
                                            <span style="display:inline-block;vertical-align:text-bottom;margin-left:6px">
                                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                                    <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">Positive either IgG/IgM</span>
                                                    <img src="{{ whatBox(($screening['companion'][4]['child'][2]['child'][1]['answer'] ?? ''), 'Positive either IgG/IgM') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                                </span>
                                            </span>
                                        </span><br>
                                        <span style="display:inline-block;margin-top:-10px;margin-left:104px">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:0">
                                                <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">Negative both IgG/IgM</span>
                                                <img src="{{ whatBox(($screening['companion'][4]['child'][2]['child'][1]['answer'] ?? ''), 'Negative both IgG/IgM') }}" style="display:inline-block;vertical-align:0;margin:0 5px 0 5px;line-height:1">
                                            </span>
                                        </span>
                                    </p>
                                </span>
                                <p style="margin-bottom:6px">
                                    <strong><u>If POSITIVE IgG/IgM: </u></strong>
                                    <span>
                                        <span style="margin-bottom:2px">Have you had RT-PCR Test (swab test)?</span>
                                        <span class="option" style="margin-left:134px">
                                            <img src="{{ whatBox(($screening['companion'][4]['child'][2]['child'][1]['child'][1]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                        </span>
                                        <span class="option">
                                            <img src="{{ whatBox(($screening['companion'][4]['child'][2]['child'][1]['child'][1]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO</span>
                                        </span>
                                    </span>
                                </p>
                                <p style="margin-bottom:6px">
                                    <strong><u>If RT-PCR not done: </u></strong>
                                    <span>
                                        <span style="margin-bottom:2px">Have you completed the 14 days quarantine?</span>
                                        <span class="option" style="margin-left:60px">
                                            <img src="{{ whatBox(($screening['companion'][4]['child'][2]['child'][1]['child'][1]['child'][1]['answer'] ?? ''), 'Yes') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">YES</span>
                                        </span>
                                        <span class="option">
                                            <img src="{{ whatBox(($screening['companion'][4]['child'][2]['child'][1]['child'][1]['child'][1]['answer'] ?? ''), 'No') }}" style="display:inline-block;vertical-align:middle;margin:0 5px 0 5px;line-height:1">
                                            <span style="display:inline-block;vertical-align:middle;margin:0;line-height:1">NO</span>
                                        </span>
                                    </span>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p style="text-align:center;line-height:1">In compliance with RA 11332 <em>Mandatory Reporting of Notifiable Diseases and Health Events of Public Health<br> Concern Act</em>, I have provided truthful information about my health condition and possible exposure.</p>
            <table class="table-signatures">
                <tr>
                    <td>
                        <span style="border-bottom:1px dashed #111;display:inline-block;padding-bottom:2px;vertical-align:middle;width:100%">&nbsp;</span>
                        <p style="text-align:center;line-height:1;font-size:10px">Companion’s signature above printed name</p>
                    </td>
                    <td>
                        <span style="border-bottom:1px dashed #111;display:inline-block;padding-bottom:2px;vertical-align:middle;width:100%">&nbsp;</span>
                        <p style="text-align:center;line-height:1;font-size:10px">Relationship to Patient</p>
                    </td>
                    <td>
                        <span style="border-bottom:1px dashed #111;display:inline-block;padding-bottom:2px;vertical-align:middle;width:100%">&nbsp;</span>
                        <p style="text-align:center;line-height:1;font-size:10px">Date <small style="color:#777">(MMM/DD/YYYY)</small> and<br> Time <small style="color:#777">(00:00)</small></p>
                    </td>
                </tr>
            </table>
            <p style="font-size:10px;margin-bottom:2px"><strong>Companion’s Disposition:</strong></p>
            <ul class="patient-disposition">
                <li>{!! ($screening['companion'][1]['child'][2]['answer'] ?? '') == 'Worsening' ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Proceed to Emergency Department</li>
                <br><li>{!! ($screening['companion'][1]['child'][2]['answer'] ?? '') == 'Stable/Improving' 
                    // || ($screening['companion'][2]['child'][1]['answer'] ?? '') == 'No'
                    || ($screening['companion'][2]['child'][1]['child'][1]['answer'] ?? '') == 'No'
                    || (($screening['companion'][3]['child'][1]['answer'] ?? '') == 'No' && ($screening['companion'][3]['child'][2]['answer'] ?? '') == 'No')
                    || (($screening['companion'][4]['child'][1]['child'][2]['child'][1]['answer'] ?? '') == 'No' && ($screening['companion'][4]['child'][1]['child'][2]['child'][2]['answer'] ?? '') == 'No')
                    || (($screening['companion'][4]['child'][2]['child'][1]['child'][1]['child'][1]['answer'] ?? '') == 'No') ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Refer for Teleconsultation</li>
                <br><li>{!! ($screening['companion'][1]['answer'] ?? '') != 'Yes'
                && ($screening['companion'][2]['child'][1]['answer'] ?? '') != 'No'
                && (($screening['companion'][4]['child'][1]['child'][2]['child'][1]['answer'] ?? '') != 'No' && ($screening['companion'][4]['child'][1]['child'][2]['child'][2]['answer'] ?? '') != 'No')
                && (($screening['companion'][4]['child'][2]['child'][1]['child'][1]['child'][1]['answer'] ?? '') != 'No') ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} May accompany patient</li>
                <br><li>{!! (($screening['companion'][4]['child'][1]['child'][2]['child'][1]['answer'] ?? '') == 'No' && ($screening['companion'][4]['child'][1]['child'][2]['child'][2]['answer'] ?? '') == 'No')
                    || (($screening['companion'][4]['child'][2]['child'][1]['child'][1]['child'][1]['answer'] ?? '') == 'No')
                    || (($screening['companion'][2]['child'][1]['answer'] ?? '') == 'No' && ($screening['companion'][2]['child'][1]['child'][1]['answer'] ?? '') == 'No') ? '<span style="color:#002060">&#9635;</span>' : '&#x2610;' !!} Refer to ABC Hospital Laboratory for RT-PCR Testing</li>
            </ul>
            <div class="footer companion">
                <p style="font-size:10px;margin-bottom:2px"><strong>Validated by:</strong></p>
                <table class="table-validate">
                    <tr>
                        <td>
                            <span style="border-bottom:1px dashed #111;display:inline-block;padding-bottom:2px;vertical-align:middle;width:100%">&nbsp;</span>
                            <p style="text-align:center;line-height:1;font-size:10px">Healthcare Worker’s Signature Above Printed Name</p>
                        </td>
                        <td>
                            <span style="border-bottom:1px dashed #111;display:inline-block;padding-bottom:2px;vertical-align:middle;width:100%">&nbsp;</span>
                            <p style="text-align:center;line-height:1;font-size:10px">Designation</p>
                        </td>
                        <td>
                            <span style="border-bottom:1px dashed #111;display:inline-block;padding-bottom:2px;vertical-align:middle;width:100%">&nbsp;</span>
                            <p style="text-align:center;line-height:1;font-size:10px">Date <small style="color:#777">(MMM/DD/YYYY)</small> and<br> Time <small style="color:#777">(00:00)</small></p>
                        </td>
                    </tr>
                </table>
                <p style="font-size:9.5px;line-height:1;margin-bottom:0"><strong>Validity:</strong> This screening form is valid for five (5) days. Any symptom which may develop or any unprotected exposure within this coverage period for the Patient will automatically invalidate this initial screening session. Patient should accomplish a new screening form.</p>
                <p style="color:#777;line-height:1;margin-top:10px;margin-bottom:0">FM-ABC Hospital-GF-402-A Rev 00 June 2020</p>
            </div>
        </div>
    </body>
</html>
