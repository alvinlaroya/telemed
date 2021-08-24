<template>
    <div class="dynamic-forms">
        <div class="questions-parent">
            <h5>Form Questions</h5>
            <div class="card questions mb-3">
                <ul class="list-group list-group-flush">
                    <draggable v-model="items" draggable=".list-group-item">
                    <li v-for="(values, key) in items" class="list-group-item pb-4">

                        <!-- Single Field Type || Text Field Type -->
                        <template v-if="values.type == 'field' || values.type == 'text'">
                            <div class="card-header">
                               <a href="javascript:;" class="text-danger mr-2"
                                @click="removeQuestion(key)"><i class="fa fa-times-circle"></i></a>
                                <a href="javascript:;" class="text-info mr-3 float-right"><i class="fa fa-arrows-alt"></i></a>
                                <em class="small"><strong>(Type: {{ options[values.type] }})</strong></em>
                            </div>
                            <div class="card-footer">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" :id="'defaultCheck' + key"
                                        v-model="items[key].required">
                                    <label class="form-check-label" :for="'defaultCheck' + key">
                                        Required to answer
                                    </label>
                                </div>
                                <div class="input-group mb-0 mt-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Question</span>
                                    </div>
                                    <input type="text" class="form-control" required
                                        v-model="items[key].question">
                                    <input type="hidden"
                                        v-model="items[key].type">
                                </div>
                            </div>
                        </template>

                        <!-- Radio Field Type || Checkbox Field Type -->
                        <template v-if="values.type == 'radio' || values.type == 'checkbox'">
                            <div class="card-header">
                                <a href="javascript:;" class="text-danger mr-2"
                                    @click="removeQuestion(key)"><i class="fa fa-times-circle"></i></a>
                                <a href="javascript:;" class="text-info mr-3 float-right"><i class="fa fa-arrows-alt"></i></a>
                                <em class="small"><strong>(Type: {{ options[values.type] }})</strong></em>
                            </div>
                            <div class="card-footer">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" :id="'defaultCheck' + key"
                                        v-model="items[key].required">
                                    <label class="form-check-label" :for="'defaultCheck' + key">
                                        Required to answer
                                    </label>
                                </div>
                                <div class="input-group mb-2 mt-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Question</span>
                                    </div>
                                    <input type="text" class="form-control" required
                                        v-model="items[key].question">
                                    <input type="hidden"
                                        v-model="items[key].type">
                                </div>
                                <div class="options-group">
                                    <label class="control-label">Options
                                        <a href="javascript:;" class="btn btn-success btn-sm"
                                            @click="addOption(key)"><i class="fa fa-plus"></i></a>
                                    </label>
                                    <div class="input-group mb-1" v-for="(option, innerKey) in items[key].options">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ innerKey + 1 }}</span>
                                        </div>
                                        <input type="text" class="form-control" required
                                            v-model="items[key].options[innerKey]">
                                        <div class="input-group-append">
                                            <a href="javascript:;" class="btn btn-danger"
                                                v-bind:class="{ 'disabled': items[key].options.length < 2 }"
                                                @click="removeOption(key, innerKey)"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </li>
                    </draggable>
                </ul>
            </div>
        </div>

        <hr>
        <div class="actions form-group">
            <h4 for="question-type" class="control-label"><strong>Add Question </strong></h4>
            <div class="input-group">
                <select name="type" id="question-type" class="form-control" v-model="questionAdd" placeholder="Select question type...">
                    <option v-for="(val, key) in options" :value="key">{{ val }}</option>
                </select>
                <div class="input-group-append">
                    <button @click="addQuestion()" type="button" class="btn btn-primary">Add Item</button>
                </div>
            </div>
        </div>
        <button @click="saveForm()" class="btn btn-primary">Update Form</button>

    </div>
</template>
<script>
    import draggable from 'vuedraggable';

    export default {
        mounted() {
            this.initializeValues();
            console.log('Component mounted.')
        },

        props: ['existingItems','url','savingType'],

        components: {
            draggable,
        },

        data: function() {
            return {
                busy: false,
                items: [],
                options: {
                    'field': 'One Line Field',
                    'text': 'Paragraph',
                    'radio': 'Radio Options',
                    'checkbox': 'Checkbox Options'
                },
                questionAdd: 'field'
            }
        },

        methods: {

            initializeValues() {
                console.log(this.existingItems, typeof this.existingItems)
                // let decoded = JSON.parse(this.existingItems);
                // console.log(decoded)
                this.items = this.existingItems
            },

            addQuestion() {
                if (!this.busy) {
                    this.busy = true;
                    let arrayToAdd = {};

                    switch (this.questionAdd) {
                        case 'field':
                            arrayToAdd = {question: '', required: true, type: 'field'};
                        break;

                        case 'text':
                            arrayToAdd = {question: '', required: true, type: 'text'};
                        break;

                        case 'radio':
                            arrayToAdd = {question: '', required: true, type: 'radio', options: ['']};
                        break;

                        case 'checkbox':
                            arrayToAdd = {question: '', required: true, type: 'checkbox', options: ['']};
                        break;
                    }

                    this.items.push(arrayToAdd);
                    this.busy = false;
                }
            },

            removeQuestion(key) {
                this.items.splice(key, 1);
            },

            addOption(key) {
                this.items[key].options.push('');
            },

            removeOption(key, innerKey) {
                this.items[key].options.splice(innerKey, 1);
            },

            saveForm() {
                if(!this.busy) {
                    if (this.items.length < 1) {
                        alert('Enter some questions to continue!');
                        return;
                    }

                    this.busy = true;
                    let formData = {
                        items: this.items,
                        saving_type: this.savingType
                    }

                    axios.post(this.url, formData)
                        .then(response => {
                            // console.log(response, response.data);
                            this.items = response.data
                            if ($('.cf-v').length > 0) {
                                $('.cf-v').toast('show')
                            }
                            // alert("Successfully saved!");
                        })
                        .catch(error => {
                            alert("Error saving!", { theme: 'text-danger'});
                        })
                        .finally(() =>
                            this.busy = false
                        )
                }
            }
        }
    }
</script>
