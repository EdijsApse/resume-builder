<template>
    <div class="left-sidebar">
        <h3>Admin Sections</h3>
        <ul>
            <li @click="$router.push({ name: 'AdminLanguages' })" :class="{'selected-section': $route.name === 'AdminLanguages'}">
                <i class="fa-solid fa-language"></i>
                <span>Languages</span>
            </li>
        </ul>
    </div>
</template>