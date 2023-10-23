<template>
    <div class="resume-section-wrapper relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <base-resume-section-header :isCloseButtonVisible="false">{{
            $t("resume.soft_skills")
        }}</base-resume-section-header>

        <p class="info-text">{{ $t("forms.select_skills_text") }}</p>

        <div
            class="list-items-wrapper predefined-skills"
            v-if="suggestedSkills.length"
        >
            <base-list-item
                v-for="skill in suggestedSkills"
                :key="skill"
                :canRemove="false"
                @item-clicked="addPredefiendSkill(skill)"
            >
                {{ skill }}<i class="fa-solid fa-plus"></i>
            </base-list-item>
        </div>

        <form @submit.prevent="addSkill">
            <div class="form-group">
                <input
                    type="text"
                    :placeholder="$t('forms.enter_skill')"
                    class="form-control"
                    v-model.trim="item"
                />
                <svg
                    width="30px"
                    height="30px"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    @click="addSkill"
                >
                    <path
                        d="M19,6a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H7.41l1.3-1.29A1,1,0,0,0,7.29,9.29l-3,3a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L7.41,14H17a3,3,0,0,0,3-3V7A1,1,0,0,0,19,6Z"
                    />
                </svg>
            </div>
        </form>

        <div class="list-items-wrapper" v-if="items.length">
            <base-list-item
                v-for="skill in items"
                :key="skill"
                @remove-item="removeItem(skill)"
            >
                {{ skill }}
            </base-list-item>
        </div>
        <p class="mb-0 info-text" v-else>
            {{ $t("forms.no_skills_added") }}<br />{{
                $t("forms.add_your_skill_text")
            }}
        </p>
        <button type="button" class="btn btn-primary mt-6" @click="saveSkills">
            {{ $t("forms.save") }}
        </button>
    </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            predefined_skills: [
                this.$t("resume.soft_skill_1"),
                this.$t("resume.soft_skill_2"),
                this.$t("resume.soft_skill_3"),
                this.$t("resume.soft_skill_4"),
                this.$t("resume.soft_skill_5"),
                this.$t("resume.soft_skill_6"),
                this.$t("resume.soft_skill_7"),
                this.$t("resume.soft_skill_8"),
                this.$t("resume.soft_skill_9"),
                this.$t("resume.soft_skill_10"),
            ],
            item: "",
            items: [],
            isLoading: false,
        };
    },
    computed: {
        ...mapState("softSkill", ["softSkill"]),
        ...mapGetters("softSkill", ["hasSoftSkills"]),
        suggestedSkills() {
            return this.predefined_skills.filter((skill) => {
                return !this.items.includes(skill);
            });
        },
    },
    mounted() {
        this.loadSkills();
    },
    methods: {
        ...mapActions("softSkill", ["save", "loadItems", "saveItems"]),
        async loadSkills() {
            this.isLoading = true;
            await this.loadItems().finally(() => {
                this.isLoading = false;
                if (this.hasSoftSkills) {
                    this.items = [...this.softSkill.list];
                }
            });
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
            this.item = "";
        },
        removeItem(skill) {
            this.items = this.items.filter((existing) => existing !== skill);
        },
    },
};
</script>

<style scoped lang="scss">
@import "@style/_variables.scss";
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
