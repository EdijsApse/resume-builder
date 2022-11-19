<template>
    <div class="contact-section">
        <h2>{{ $t('resume.contact') }}</h2>
        <ul>
            <li v-if="profile.phone">
                <div class="single-contact">
                    <p class="contact-type">{{ $t('resume.mobile') }}</p>
                    <p class="contact-value">{{ profile.phone }}</p>
                </div>
            </li>
            <li v-if="profile.email">
                <div class="single-contact">
                    <p class="contact-type">{{ $t('resume.email') }}</p>
                    <p class="contact-value">{{ profile.email }}</p>
                </div>
            </li>
            <li v-if="profile.website">
                <div class="single-contact">
                    <p class="contact-type">{{ $t('resume.website') }}</p>
                    <p class="contact-value">{{ $t('resume.portfolio_can_be_viewed') }} <a :href="profile.website">{{ $t('resume.here') }}</a></p>
                </div>
            </li>
            <li v-if="profile.address">
                <div class="single-contact">
                    <p class="contact-type">{{ $t('resume.address') }}</p>
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