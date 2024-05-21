import './bootstrap';

import Alpine from 'alpinejs';
import anchor from '@alpinejs/anchor';
import axios from "axios";
import * as Validator from 'validatorjs';

Alpine.data('quillEditor', () => ({
    content: null,

    init() {
        const quill = new Quill(this.$refs.editor, {
            modules: {
                toolbar: [
                    ['bold', 'italic'],
                    ['link'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                ],
            },
            theme: 'snow',
        });

        quill.on("editor-change", (eventName, ...args) => {
            if (eventName === "text-change") {
                this.content = quill.root.innerHTML;


                console.log(this.content);
            }
        });
    }
}));

Alpine.data('reportGenerator', () => ({
    print() {
        const content = this.$refs.content;
        const pageHeader = this.$refs.pageHeader;
        const reportCanvas = this.$refs.reportCanvas;

        content.classList.toggle('w-3/5');
        pageHeader.classList.toggle('hidden');
        this.toggleClasses('bg-white', 'py-4', 'px-5');

        window.print();

        content.classList.toggle('w-3/5');
        pageHeader.classList.toggle('hidden');
        this.toggleClasses('bg-white', 'py-4', 'px-5');
    },

    toggleClasses(...classes) {
        const reportCanvas = this.$refs.reportCanvas;

        for (const cName of classes) {
            reportCanvas.classList.toggle(cName);
        }
    }
}));

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

Alpine.data('feedbackForm', () => ({
    open: false,

    init() {
        setTimeout(() => {
            this.open = true;
        }, 1000);
    },
}));

Alpine.data('starRating', () => ({
    rating: 1,
}));

Alpine.data('feedbackCard', (feedbackId) => ({
    id: feedbackId,
    open: true,
    displayToggleBtn: true,
    previewHidden: false,

    checkContentHeight() {
        const contentHeight = document.getElementById(`wholeContent${this.id}`).clientHeight;
        const wrapper = document.getElementById(`contentWrapper${this.id}`);
        const button = document.getElementById(`toggleButton${this.id}`);

        console.log(contentHeight);

        if (contentHeight <= 64) { this.hideToggleBtn(); }

        if (wrapper.classList.contains('sr-only')) {
            button.textContent = 'Show less';
        } else {
            button.textContent = 'Read more';
        }
    },

    hideToggleBtn() {
        const buttonWrapper = document.getElementById(`toggleButtonWrapper${this.id}`);
        const button = document.getElementById(`toggleButton${this.id}`);

        // buttonWrapper.classList.toggle('hidden');

        // this.open = !this.open;
    },

    toggle() {
        const wrapper = document.getElementById(`contentWrapper${this.id}`);
        const preview = document.getElementById(`previewWrapper${this.id}`);
        const contentHeight = document.getElementById(`wholeContent${this.id}`).clientHeight;
        const button = document.getElementById(`toggleButton${this.id}`);

        console.log(wrapper, contentHeight);

        // this.open = !this.open;

        // wrapper.classList.toggle('sr-only');
        this.previewHidden = !this.previewHidden;
        // preview.classList.toggle('sr-only');
    }
}));

window.Alpine = Alpine;

Alpine.plugin(anchor);

Alpine.start();
