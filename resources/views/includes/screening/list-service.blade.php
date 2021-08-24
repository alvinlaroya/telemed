<li>
    <span class="list-title">Do you currently have any of the following symptoms?</span>
    <input type="hidden" name="screening[0][question]" value="Do you currently have any of the following symptoms?">
    <input type="hidden" name="screening[0][type]" value="radio">
    <textarea name="screening[0][desc]" style="display:none">
        <ul>
            <li>Body Weakness</li>
            <li>Cough</li>
            <li>Diarrhea</li>
            <li>Fever</li>
            <li>Loss of Taste/Smell</li>
            <li>Shortness of Breath or Trouble in Breathing</li>
            <li>Throat Pain</li>
        </ul>
    </textarea>
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="screening[0][answer][yes]" name="screening[0][answer]" type="radio" class="custom-control-input" value="1" >
            <label class="custom-control-label" for="screening[0][answer][yes]">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="screening[0][answer][no]" name="screening[0][answer]" type="radio" class="custom-control-input" value="0" >
            <label class="custom-control-label" for="screening[0][answer][no]">No</label>
        </div>
    </div>
    <ul>
        <li>Body Weakness</li>
        <li>Cough</li>
        <li>Diarrhea</li>
        <li>Fever</li>
        <li>Loss of Taste/Smell</li>
        <li>Shortness of Breath or Trouble in Breathing</li>
        <li>Throat Pain</li>
    </ul>
</li>
<li class="service-q-2-3" style="display:none">
    <span class="list-title">Do you live in a community with documented local COVID-19 transmission?</span>
    <input type="hidden" name="screening[1][question]" value="Do you live in a community with documented local COVID-19 transmission?">
    <input type="hidden" name="screening[1][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="screening[1][answer][yes]" name="screening[1][answer]" type="radio" class="custom-control-input" value="1" >
            <label class="custom-control-label" for="screening[1][answer][yes]">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="screening[1][answer][no]" name="screening[1][answer]" type="radio" class="custom-control-input" value="0" >
            <label class="custom-control-label" for="screening[1][answer][no]">No</label>
        </div>
    </div>
</li>
<li class="service-q-2-3" style="display:none">
    <span class="list-title">Any travel history for the past 14 days?</span>
    <input type="hidden" name="screening[2][question]" value="Any travel history for the past 14 days?">
    <input type="hidden" name="screening[2][type]" value="radio">
    <div class="my-3 form-check-inline">
        <div class="custom-control custom-radio form-check-input">
            <input id="screening[2][answer][yes]" name="screening[2][answer]" type="radio" class="custom-control-input" value="1" >
            <label class="custom-control-label" for="screening[2][answer][yes]">Yes</label>
        </div>
        <div class="custom-control custom-radio form-check-input">
            <input id="screening[2][answer][no]" name="screening[2][answer]" type="radio" class="custom-control-input" value="0" >
            <label class="custom-control-label" for="screening[2][answer][no]">No</label>
        </div>
    </div>
</li>
<div class="alert alert-success service-yes" style="display:none" role="alert">
    Kindly monitor your health.  If you experience any symptoms, please see a Doctor or Emergency Department for further assessment.
</div>
<div class="alert alert-success service-no" style="display:none" role="alert">
    Thank you for your reply.
</div>
