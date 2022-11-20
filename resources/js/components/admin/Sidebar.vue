<template>
    <div class="left-sidebar">
        <h3>{{ $t('admin.admin_section') }}</h3>
        <ul>
            <li @click="$router.push({ name: 'AdminLanguages' })" :class="{'selected-section': $route.name === 'AdminLanguages'}">
                <i class="fa-solid fa-lock"></i>
                <span>{{ $t('admin.languages') }}</span>
            </li>
            <li @click="$router.push({ name: 'AdminLanguageLevels' })" :class="{'selected-section': $route.name === 'AdminLanguageLevels'}">
                <i class="fa-solid fa-lock"></i>
                <span>{{ $t('admin.language_levels') }}</span>
            </li>
        </ul>
    </div>
</template>

<script></script>