<template>
    <div class="single-section">
        <h2>Work experience</h2>
        <ul>
            <li v-for="exp in items" :key="exp.id">
                <div class="single-list-item">
                    <p class="item-title">{{ exp.jobtitle }}</p>
                    <p class="item-subtitle">{{ exp.employer }} | {{ exp.from_converted }} - {{ exp.to_converted }}</p>
                    <p class="item-description" v-if="exp.duties">{{ exp.duties }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        computed: {
            ...mapState('experience', ['items'])
        }
    }
</script>