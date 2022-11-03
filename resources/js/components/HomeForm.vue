<template>
    <div class="intro-form">
        <h2>Basic <span class="pink">information</span></h2>
        <form class="form">
            <div class="form-group-row">
                <div class="form-group">
                    <input type="text" placeholder="First name" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Last name" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Email address" class="form-control" />
            </div>
            <div class="form-group">
                <input type="tel" placeholder="Phone number" class="form-control" />
            </div>
            <div class="form-group">
                <textarea placeholder="About you" class="form-control" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Next step</button>
        </form>
    </div>
</template>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .intro-form {
        background-color: #FFF;
        padding: $space-8;
        max-width: 360px;
        h2 {
            font-weight: 400;
            color: $dark-gray;
            font-size: 1.5rem;
            margin-bottom: $space-4;
        }
        .btn {
            margin-top: $space-6;
            width: 100%;
        }
    }
    .pink {
        color: $pink;
        text-transform: capitalize;
    }
</style>