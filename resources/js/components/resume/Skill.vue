<template>
    <div class="resume-section-wrapper relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <base-resume-section-header :isCloseButtonVisible="false">Skills</base-resume-section-header>
        
        <p class="info-text">Choose predefined skills provided for you or add your own if none of them matches your skillset!</p>
        
        <div class="list-items-wrapper predefined-skills" v-if="suggestedSkills.length">
            <base-list-item v-for="skill in suggestedSkills" :key="skill" :canRemove="false" @item-clicked="addPredefiendSkill(skill)">
                {{ skill }}<i class="fa-solid fa-plus"></i>
            </base-list-item>
        </div>

        <form @submit.prevent="addSkill">
            <div class="form-group">
                <input type="text" placeholder="Enter skill" class="form-control" v-model.trim="item" />
                <svg width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" @click="addSkill">
                    <path d="M19,6a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H7.41l1.3-1.29A1,1,0,0,0,7.29,9.29l-3,3a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L7.41,14H17a3,3,0,0,0,3-3V7A1,1,0,0,0,19,6Z"/>
                </svg>
            </div>
        </form>

        <div class="list-items-wrapper" v-if="items.length">
            <base-list-item v-for="skill in items" :key="skill" @remove-item="removeItem(skill)">
                {{ skill }}
            </base-list-item>
        </div>
        <p class="mb-0 info-text" v-else>No skills added yet.<br />Add your skill or select one of provided!</p>
        <button type="button" class="btn btn-primary mt-6" @click="saveSkills">Save</button>
    </div>
</template>

<script>
    import { mapState, mapActions, mapGetters } from 'vuex';
    export default {
        data() {
            return {
                predefined_skills: ['Flexibility and Adaptability', 'Hard Working', 'Good Communication', 'Critical Thinking Skills', 'Highly responsible and reliable', 'Interpersonal Communication', 'Leadership and Teamwork', 'Customer Service Skills', 'Communication Skills', 'Analytical Skills'],
                item: '',
                items: [],
                isLoading: false
            }
        },
        computed: {
            ...mapState('skill', ['skills']),
            ...mapGetters('skill', ['hasSkills']),
            suggestedSkills() {
                return this.predefined_skills.filter((skill) => {
                    return !this.items.includes(skill);
                })
            }
        },
        mounted() {
            this.loadSkills();
        },
        methods: {
            ...mapActions('skill', ['save', 'loadItems', 'saveItems']),
            async loadSkills() {
                this.isLoading = true;
                await this.loadItems().finally(() => {
                    this.isLoading = false;
                    if (this.hasSkills) {
                        this.items = [...this.skills.list];
                    }
                })
            },
            async saveSkills() {
                this.isLoading = true;
                await this.saveItems(this.items).finally(() => {
                    this.isLoading = false;
                });
            },
            addPredefiendSkill(skill) {
                this.items.push(skill);
            },
            addSkill() {
                if (!this.item) {
                    return;
                }
                this.items.push(this.item);
                this.item = '';
            },
            removeItem(skill) {
                this.items = this.items.filter(existing => existing !== skill);
            }
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .info-text {
        margin-bottom: $space-4;
        font-family: $open-sans-light;
        color: $darkish-gray;
        font-size: 0.9rem;
        max-width: 24rem;
    }
    .list-items-wrapper {
        display: flex;
        flex-wrap: wrap;
        margin-left: -0.25rem;
        margin-right: -0.25rem;
    }
    .predefined-skills {
        border-bottom: 1px solid $brightish-gray;
        padding-bottom: $space-6;
        margin-bottom: $space-6;
    }

    .form-group {
        position: relative;
        width: 50%;
        input {
            padding-right: 35px;
        }
        &:focus-within {
            svg {
                path {
                    fill: $pink;
                }
            }
        }
        svg {
            position: absolute;
            right: 8px;
            top: 8px;
            opacity: 0.8;
            path {
                fill: $bright-gray;
                transition: all 0.3s;
            }
        }
    }
</style>