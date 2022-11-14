<template>
    <div class="contact-section">
        <h2>Contact</h2>
        <ul>
            <li v-if="profile.phone">
                <div class="single-contact">
                    <p class="contact-type">Mobile</p>
                    <p class="contact-value">{{ profile.phone }}</p>
                </div>
            </li>
            <li v-if="profile.email">
                <div class="single-contact">
                    <p class="contact-type">Email</p>
                    <p class="contact-value">{{ profile.email }}</p>
                </div>
            </li>
            <li v-if="profile.website">
                <div class="single-contact">
                    <p class="contact-type">Website</p>
                    <p class="contact-value">Portfolio can be viewed <a :href="profile.website">here</a></p>
                </div>
            </li>
            <li v-if="profile.address">
                <div class="single-contact">
                    <p class="contact-type">Address</p>
                    <p class="contact-value">{{ profile.address }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: {
            ...mapState('profile', ['profile'])
        }
    }
</script>