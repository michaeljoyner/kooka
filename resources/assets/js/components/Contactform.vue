<style></style>

<template>
    <form class="kooka-contact-form" :action="form-action" v-on:submit.stop.prevent="sendMessage" :class="{'spent': spent}">
        <div class="double-input-row">
            <div class="form-group">
                <label for="name">Name: </label>
                <input type="text" name="name" v-model="name">
            </div>
            <div class="form-group">
                <label for="name">Email: </label>
                <input type="email" name="email" v-model="email">
            </div>
        </div>
        <div class="message-box">
            <div class="form-group">
                <label for="name">Message: </label>
                <textarea name="enquiry" v-model="enquiry"></textarea>
            </div>
        </div>
        <div class="button-box">
            <button type="submit" class="form-submit-button">
                <span v-show="!sending">Send</span>
                <div class="spinner" v-show="sending">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </button>
        </div>
        <div class="thanks-cover" :class="{'show': spent}">
            <p class="thanks-note">Thank you {{ name }}. We will be in touch soon!</p>
            <div class="reset-button" v-on:click="resetForm">Send another message</div>
        </div>
    </form>
</template>

<script type="text/babel">
    module.exports = {

        props: ['form-action'],

        data() {
            return {
                name: '',
                email: '',
                enquiry: '',
                sending: false,
                spent: false
            }
        },

        methods: {

            sendMessage() {
                if(! this.inValidState()) return;
                this.sending = true;

                this.$http.post(this.formAction, {
                    name: this.name,
                    email: this.email,
                    enquiry: this.enquiry
                })
                        .then(() => this.onSuccess())
                        .catch(() => this.onFailure())
            },

            inValidState() {
                return this.name != '' && this.email != '';
            },

            onSuccess() {
                this.sending = false;
                this.spent = true;
            },

            onFailure() {
                this.sending = false;
                this.$dispatch('message', {
                    type: 'error',
                    title: 'Oops. Sorry',
                    text: 'There was a problem processing your message. If it persists, kindly use one of our alternative contact methods.',
                    confirm: true
                });
            },

            resetForm() {
                this.name = '';
                this.email = '';
                this.enquiry = '';
                this.spent = false;
            }
        }
    }
</script>