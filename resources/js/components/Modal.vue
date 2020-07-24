<template>
    <div>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            Create Event
                            <button type="button" class="close" aria-label="Close" @click="$emit('close')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <div class="form-group">
                                <label >Event name</label>
                                <input type="text"  class="form-control" v-model="name">
                            </div>
                            <div class="form-group">
                                <label >Event Category</label>
                                <select class="form-control" v-model="category_id">
                                    <option v-for="cat in JSON.parse(this.eventCategories)" :value="cat.id">{{ cat.name }}</option>
                                </select>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label >Event starts</label>
                                    <input type="datetime-local" v-model="startDate" name="birthdaytime">
                                </div>
                                <div class="col-sm-6">
                                    <label >Event ends</label>
                                    <input type="datetime-local" v-model="endDate"  name="birthdaytime">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Event description</label>
                                <textarea class="form-control" v-model="description" rows="3"></textarea>
                            </div>
                        </slot>
                    </div>
                    <div v-if="formErrors.length" class="form-group">
                        <div v-for="error in formErrors">
                            <div class="alert alert-danger" role="alert">
                                {{ error }}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">

                            <button type="submit" class="btn btn-danger" @click="deleteEvent">Remove Event</button>
                            <button type="submit" class="btn btn-primary" @click="handleEventSubmit">Submit</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- This is basically one simple model for controlling your events. -->
<!-- Modal should give you the ability to maintain and control events like creating, viewing and deleting. -->

<script>
    const moment = require('moment'); // using moment for format date and time
    const axios = require('axios').default; // using axios for HTTP calls
    export default {
        name: "Modal",
        props: ['activeDate','eventCategories'],
        data() {
            return {
                modalStatus: false,
                endEventStatus: false,
                name: '',
                description: '',
                category_id: 1,
                endDate: '',
                startDate: '',
                formErrors: [],
                csrf: '',
                responseMessage: '',
                event_id: ''
            }
        },
        methods: {
            handleEventSubmit: function (arg, err) {  // handling event form submit
                this.validateForm();
                if (this.formErrors.length)
                    return

                let formData = new FormData()
                formData.append('_token', this.csrf)
                formData.append('name',this.name)
                formData.append('description',this.description)
                formData.append('category_id',this.category_id)
                formData.append('starts_at',this.startDate)
                formData.append('ends_at',this.endDate)

                if(this.event_id){
                    axios.post(`/dash/event/update/`+this.event_id, formData, {'Content-Type': 'application/json'})
                        .then(arg =>{
                            this.$emit('close')
                            this.$emit('addedEvent',{'message': arg.data.success, 'data': arg.data.event})
                        }).catch(error => { this.handleError(error) });
                }else{
                    axios.post(`/dash/event/new`, formData, {'Content-Type': 'application/json'})
                    .then(arg =>{
                        this.$emit('close')
                        this.$emit('addedEvent',{'message': arg.data.success, 'data': arg.data.event})
                    }).catch(error => { this.handleError(error) });
                }
            },
            validateForm: function(){ // simple form pre validation ( we have one also on backend )
                this.formErrors = []
                if(this.startDate > this.endDate)
                    this.formErrors.push('End date cannot be smaller than Start date')

                if(this.name == '')
                    this.formErrors.push('Name is required!')
            },
            handleError: function (error) {  // simple error handler
                if(error) {
                    let errors = Object.entries(error.response.data.errors)
                    errors.map((error) => {
                        this.formErrors.push(error[1][0])
                    });
                }
            },
            deleteEvent: function(){ // deleting method for removing events from calendar ( with confirmation and update all events in calendar )
                if(confirm("Are you sure you want to delete event "+this.name)){
                    this.activeDate.event.remove()
                    let formData = new FormData()
                    formData.append('_token', this.csrf)
                    formData.append('_method', 'DELETE')
                    formData.append('id', this.event_id)

                    axios.post(`/dash/event/delete`,formData, {'Content-Type': 'application/json'})
                        .then(arg =>{
                            this.$emit('addedEvent',{'message': arg.data.success })
                        }).catch(error => { this.handleError(error) })
                    this.$emit('close')
                }
            }
        },
        mounted() { // receiving data/event for modal when modal is shown
            this.csrf = document.querySelector('input[name="_token"]').value
            if(this.activeDate.id){
                axios.get(`/dash/event/get/`+this.activeDate.id,{}, {'Content-Type': 'application/json'})
                    .then(arg =>{
                        let data = JSON.parse(arg.data.success)
                        this.name = data.name
                        this.description = data.description
                        this.startDate = moment(new Date(data.starts_at).toISOString()).format('YYYY-MM-DDTHH:mm:ss')
                        this.endDate = moment(new Date(data.ends_at).toISOString()).format('YYYY-MM-DDTHH:mm:ss')
                        this.event_id = data.id
                        this.category_id = data.category_id
                    })
            }else {
                this.startDate = moment(new Date(this.activeDate.startStr).toISOString()).format('YYYY-MM-DDTHH:mm:ss');
                this.endDate = moment(new Date(this.activeDate.endStr).toISOString()).format('YYYY-MM-DDTHH:mm:ss');
            }
        }
    }
</script>
<!-- Simple css classes for modal styling with responsiveness -->
<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 100%;
        max-width: 550px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

</style>
