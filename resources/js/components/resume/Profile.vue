<template>
    <div class="resume-section-wrapper">
        <h2 class="mb-0">Basic information</h2>
        <form @submit.prevent="save">
            <div class="profile-image-group">
                <div class="center-block">
                    <div class="profile-image-selector">
                        <transition name="fade" mode="out-in">
                            <div class="selectable-image" v-if="!profilePhoto">
                                <img src="@images/avatar.png" @click="triggerFilePicker" />
                                <button type="button" class="btn btn-primary" @click="triggerFilePicker">Select photo</button>
                            </div>
                            <div class="removable-image" v-else>
                                <img :src="profilePhoto" />
                                <i class="fa-sharp fa-solid fa-circle-xmark remove-profile-photo" @click.stop="clearProfilePhoto"></i>
                            </div>
                        </transition>
                    </div>
                    <input type="file" class="form-control d-none" accept="image/png, image/jpeg" ref="filePicker" @change="prepareImage"/>
                </div>
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="First name" v-model.trim="firstName" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Last name" v-model.trim="lastName" />
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Occupation" v-model.trim="occupation" />
            </div>
            <!-- <div class="form-group-row">
                <div class="form-group">
                    <select class="form-control" v-model="nationality">
                        <option selected value="null">Nationality</option>
                        <option value="latvian">Latvian</option>
                    </select>
                </div>
                <div class="form-group">
                    <date-picker
                        v-model="dateOfBirth"
                        type="date"
                        placeholder="Date of birth"
                        :popup-style="{ top: '100%', left: 0}"
                        :append-to-body="false"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                    ></date-picker>
                </div>
            </div> -->
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Address" v-model.trim="address" />
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email address" v-model.trim="email" />
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" placeholder="Phone" v-model.trim="phone" />
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Link" v-model.trim="link" />
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Short self description" v-model.trim="about"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    export default {
        data() {
            return {
                filePicker: null,
                firstName: '',
                lastName: '',
                email: '',
                phone:'',
                occupation: '',
                nationality: null,
                dateOfBirth: '',
                address: '',
                link: '',
                about: '',
                nextStep: 'Experience'
            }
        },
        computed: {
            ...mapState('profile', ['profile', 'profilePhoto'])
        },
        mounted() {
            this.filePicker = this.$refs.filePicker;
            if (this.profile) {
                this.firstName = this.profile.firstName;
                this.lastName = this.profile.lastName;
                this.email = this.profile.email;
                this.phone = this.profile.phone;
                this.occupation = this.profile.occupation;
                this.nationality = this.profile.nationality;
                this.dateOfBirth = this.profile.dateOfBirth;
                this.about = this.profile.about;
                this.photo = this.profile.photo;
                this.address = this.profile.address;
                this.link = this.profile.link;
            }
        },
        methods: {
            ...mapActions('profile', ['addBasicInformation', 'clearProfilePhoto', 'addProfilePhoto']),
            save() {
                this.addBasicInformation({
                    firstName: this.firstName,
                    lastName: this.lastName,
                    email: this.email,
                    phone: this.phone,
                    occupation: this.occupation,
                    nationality: this.nationality,
                    dateOfBirth: this.dateOfBirth,
                    about: this.about,
                    photo: this.photo,
                    address: this.address,
                    link: this.link
                });

                this.$emit('next-step', this.nextStep);
            },
            triggerFilePicker() {
                this.filePicker.click();
            },
            prepareImage(event) {
                const file = event.target.files[0];
                if (!file) {
                    return;
                }
                const reader = new FileReader();
                reader.onloadend = () => {
                    this.addProfilePhoto(reader.result);
                };
                reader.readAsDataURL(file);
            }
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
        .center-block {
            max-width: 160px;
            margin-left: auto;
            margin-right: auto;
        }
        .removable-image {
            position: relative;
            .remove-profile-photo {
                position: absolute;
                right: 6px;
                top: 6px;
                color: $pink;
                font-size: 1.5rem;
                cursor: pointer;
            }
        }
        .profile-image-selector {
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
</style>