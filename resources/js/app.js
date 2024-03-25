import './bootstrap';

import Alpine from 'alpinejs';
import anchor from '@alpinejs/anchor';
import axios from "axios";
import * as Validator from 'validatorjs';

Alpine.data('studentRegForm', () => ({
    step: 1,
    data: {
        student: {
            first_name: '',
            middle_name: '',
            surname: '',
            suffix: '',
            lrn: '',
            sex: '',
            birthdate: '',
            address: '',
            phone_no: '',
            proof_image: null,
        },
        guardian: {
            first_name: '',
            middle_name: '',
            surname: '',
            suffix: '',
            phone_no: '',
            email: '',
        },
        account: {
            email: '',
            password: '',
            password_confirmation: '',
        },
    },
    errors: {
        account: {
            email: '',
            password: '',
            password_confirmation: '',
        },
        student: {
            first_name: '',
            middle_name: '',
            surname: '',
            suffix: '',
            lrn: '',
            sex: '',
            birthdate: '',
            address: '',
            phone_no: '',
            proof_image: '',
        },
        guardian: {
            first_name: '',
            middle_name: '',
            surname: '',
            suffix: '',
            phone_no: '',
            email: '',
        },
    },
    rules: {
        account: {
            email: 'required|email',
            password: 'required|min:8',
            password_confirmation: 'required|confirmed:password',
        },
    },

    next() {
        if (this.step === 4) {
            return null;
        } else {
            this.validate();
        }

        // this.step++;
    },

    back() {
        if (this.step === 1) {
            return;
        }

        this.step--;
    },

    previewUpload(e) {
        const { files } = e.target;

        const reader = new FileReader();

        reader.onload = function () {
            this.data.student.proof_image = reader.result;
        }.bind(this);

        reader.readAsDataURL(files[0]);
    },

    clearUpload() {
        this.data.student.proof_image = null;
    },

    async validate() {
        console.log(this.data.student);

        try {
            let response;

            const config = {
                header: {
                    accept: "application/json",
                    "content-type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            };

            if (this.step === 1) {
                response = await axios.post('/register/verify-account', this.data.account, config);
            }

            switch (this.step) {
                case 1:
                    response = await axios.post('/register/verify-account', this.data.account, config);
                    break;
                case 2:
                    // console.table(this.data.student);
                    response = await axios.post('/register/verify-student', this.data.student, config);
                    break;
                case 3:
                    // console.table(this.data.guardian);
                    response = await axios.post('/register/verify-guardian', this.data.guardian, config);
                    break;
                default:
                    break;
            }

            this.step++;

        } catch (error) {
            let errors = error.response.data.errors;

            switch (this.step) {
                case 1:
                    this.errors.account = errors;
                    break;
                case 2:
                    this.errors.student = errors;
                    break;
                case 3:
                    this.errors.guardian = errors;
                    break;
                default:
                    break;
            }
            // console.log(this.errors.account);
        }
    }
}));


window.Alpine = Alpine;

Alpine.plugin(anchor);

Alpine.start();
