<template>
    <ul class="features-list">
        <li>
            <div class="icon">
                <i class="fa-solid fa-pencil"></i>
            </div>
            <p>Select CV layout which fits you the best</p>
        </li>
        <li>
            <div class="icon">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>
            <p>Add the necessary information to make your CV look great</p>
        </li>
        <li>
            <div class="icon">
                <i class="fa-solid fa-eye"></i>
            </div>
            <p>Preview while you continue adding details</p>
        </li>
        <li>
            <div class="icon">
                <i class="fa-solid fa-circle-down"></i>
            </div>
            <p>Download and send it to your next employer</p>
        </li>
    </ul>
</template>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    @import '@style/_mixins.scss';
    .features-list {
        display: grid;
        grid-template-columns: 50% 50%;
        column-gap: $space-8;
        list-style: none;
        padding: 0;
        margin: 0;
        color: #FFF;
        max-width: 800px;
        li {
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            margin-bottom: $space-6;
            .icon {
                margin-right: $space-6;
                background-color: $pink;
                @include fixed-rounded-container(3rem);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
            }
            p {
                margin: 0;
                font-size: 1.2rem;
            }
        }
    }
</style>