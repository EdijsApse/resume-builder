<template>
    <div class="resume-section-wrapper relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <base-resume-section-header :isCloseButtonVisible="false">Basic information</base-resume-section-header>
        <form @submit.prevent="save">
            <div class="profile-image-group form-group">
                <div class="profile-image-selector">
                    <div class="selectable-image">
                        <transition name="fade" mode="out-in">
                            <img :src="photoUrl" @click="triggerFilePicker" />
                        </transition>
                        <i class="fa-sharp fa-solid fa-circle-xmark remove-profile-photo" @click.stop="clearProfilePhoto" v-if="canRemoveSelectedPhoto"></i>
                    </div>
                </div>
                <input type="file" class="form-control d-none" accept="image/png, image/jpeg" ref="filePicker" @change="prepareImage"/>
                <p v-if="errors['image']" class="form-error text-center">{{ errors['image'] }}</p>
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" v-model.trim="name" />
                    <p v-if="errors['name']" class="form-error">{{ errors['name'] }}</p>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input id="surname" type="text" class="form-control" v-model.trim="surname" />
                    <p v-if="errors['surname']" class="form-error">{{ errors['surname'] }}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input id="occupation" type="text" class="form-control" v-model.trim="occupation" />
                <p v-if="errors['occupation']" class="form-error">{{ errors['occupation'] }}</p>
            </div>
            <div class="form-group">
                <label for="address">Address (e.g Country and City of your location)</label>
                <input id="address" type="text" class="form-control" v-model.trim="address" />
                <p v-if="errors['address']" class="form-error">{{ errors['address'] }}</p>
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" type="tel" class="form-control" v-model.trim="phone" />
                    <p v-if="errors['phone']" class="form-error">{{ errors['phone'] }}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="link">Website (e.g link to LinkedIn profile)</label>
                <input id="link" type="text" class="form-control" v-model.trim="website" />
                <p v-if="errors['website']" class="form-error">{{ errors['website'] }}</p>
            </div>
            <div class="form-group">
                <label for="about">Tell your next employer about yourself</label>
                <textarea id="about" class="form-control" v-model.trim="professional_summary"></textarea>
                <p v-if="errors['professional_summary']" class="form-error">{{ errors['professional_summary'] }}</p>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapState, mapGetters } from 'vuex';
    import { FORM_ERROR_STATUS_CODE, mapInputErrors } from '@/helpers.js';

    export default {
        data() {
            return {
                errors: {},
                isLoading: false,
                filePicker: null,
                file: null,
                canRemoveSelectedPhoto: false,
                selectedPhotoUrl: '',
                preselectedPhoto: require('@images/avatar.png'),
                name: '',
                surname: '',
                phone:'',
                occupation: '',
                address: '',
                website: '',
                professional_summary: '',
                nextStep: 'Experience'
            }
        },
        computed: {
            ...mapState('profile', ['profile']),
            ...mapGetters('profile', ['hasProfileCreated']),
            photoUrl() {
                return this.selectedPhotoUrl ? this.selectedPhotoUrl : this.preselectedPhoto;
            }
        },
        mounted() {
            this.loadData();
            this.filePicker = this.$refs.filePicker;
        },
        methods: {
            ...mapActions('profile', ['loadUserProfile', 'saveUserProfile']),
            async loadData() {
                this.isLoading = true;
                await this.loadUserProfile().finally(() => {
                    if (this.hasProfileCreated) {
                        this.name = this.profile.name;
                        this.surname = this.profile.surname;
                        this.phone = this.profile.phone;
                        this.occupation = this.profile.occupation;
                        this.address = this.profile.address;
                        this.website = this.profile.website;
                        this.professional_summary = this.profile.professional_summary;
                        this.preselectedPhoto = this.profile.photo;
                    }
                }).finally(() => {
                    this.isLoading = false;
                })
            },

            async save() {
                this.isLoading = true;
                this.errors = {};
                await this.saveUserProfile({
                    name: this.name,
                    surname: this.surname,
                    phone: this.phone,
                    occupation: this.occupation,
                    address: this.address,
                    website: this.website,
                    professional_summary: this.professional_summary,
                    file: this.file
                })
                .then(() => {
                    this.$emit('next-step', this.nextStep);
                })
                .catch((error) => {
                    const { response } = error;
                    if (response && response.status === FORM_ERROR_STATUS_CODE) {
                        this.errors = mapInputErrors(response.data.errors);
                    }
                }).finally(() => {
                    this.isLoading = false;
                })
            },
            triggerFilePicker() {
                this.filePicker.click();
            },
            prepareImage(event) {
                const file = event.target.files[0];
                if (!file) {
                    return;
                }
                
                this.file = file;
                this.canRemoveSelectedPhoto = true;

                const reader = new FileReader();
                reader.onloadend = () => {
                    this.selectedPhotoUrl = reader.result;
                };
                reader.readAsDataURL(file);
            },
            clearProfilePhoto() {
                this.file = null;
                this.canRemoveSelectedPhoto = false;
                this.selectedPhotoUrl = '';
            },
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    @import '@style/_mixins.scss';
    .profile-image-group {
        display: block;
        width: 100%;
        margin-bottom: $space-4;
        .selectable-image {
            position: relative;
            .remove-profile-photo {
                position: absolute;
                right: 6px;
                top: 6px;
                color: $pink;
                font-size: 1.5rem;
                cursor: pointer;
                z-index: 1;
            }
        }
        .profile-image-selector {
            max-width: 160px;
            margin-left: auto;
            margin-right: auto;
            cursor: pointer;
            img {
                @include fixed-rounded-container(160px);
                object-fit: cover;
            }
        }
        .btn-primary {
            margin-top: $space-4;
        }
    }
    h2 {
        margin-bottom: $space-4;
    }
</style>