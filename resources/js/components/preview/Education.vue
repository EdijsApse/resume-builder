<template>
    <div class="single-section">
        <h2>Education</h2>
        <ul>
            <li v-for="edu in items" :key="edu.id">
                <div class="single-list-item">
                    <p class="item-title">{{ edu.school }}</p>
                    <p class="item-subtitle">{{ edu.degree }} | {{ edu.field }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        computed: {
            ...mapState('education', ['items'])
        }
    }
</script>