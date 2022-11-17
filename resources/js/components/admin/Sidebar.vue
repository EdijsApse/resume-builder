<template>
    <div class="left-sidebar">
        <h3>Admin Sections</h3>
        <ul>
            <li @click="$router.push({ name: 'AdminLanguages' })" :class="{'selected-section': $route.name === 'AdminLanguages'}">
                <i class="fa-solid fa-lock"></i>
                <span>Languages</span>
            </li>
            <li @click="$router.push({ name: 'AdminLanguageLevels' })" :class="{'selected-section': $route.name === 'AdminLanguageLevels'}">
                <i class="fa-solid fa-lock"></i>
                <span>Language levels</span>
            </li>
        </ul>
    </div>
</template>