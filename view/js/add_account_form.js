document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.querySelector('form');

    // Custom validation messages
    const customMessages = {
        firstName: {
            valueMissing: 'Please enter your name.',
            patternMismatch: 'Please enter a name without numbers.'
        },
        lastName: {
            valueMissing: 'Please enter your last name.',
            patternMismatch: 'Please enter a last name without numbers.'
        },
        email: {
            valueMissing: 'Please enter your email.',
            typeMismatch: 'Please enter a valid email address.'
        },
        age: {
            valueMissing: 'Please enter your age.',
            rangeUnderflow: 'Please enter a valid age.',
            rangeOverflow: 'Please enter a valid age.'
        },
        classSelect: {
            valueMissing: 'Please select a class.'
        },
        termsConditions: {
            valueMissing: 'You must agree to the terms and conditions.'
        }
    };

    const containsNumbers = (text) => /\d/.test(text);

    const checkValidity = (input) => {
        const validityState = input.validity;
        let feedbackElement = null;

        if (input.id === 'termsConditions') {
            feedbackElement = document.getElementById('termsConditionsFeedback');
        } else {
            feedbackElement = input.nextElementSibling && input.nextElementSibling.classList.contains('feedback') ? input.nextElementSibling : null;
            if (!feedbackElement) {
                feedbackElement = input.parentElement.querySelector('.invalid-feedback') || input.parentElement.querySelector('.valid-feedback');
            }
        }

        input.setCustomValidity('');

        if ((input.id === 'firstName' || input.id === 'lastName') && containsNumbers(input.value)) {
            input.setCustomValidity('patternMismatch');
        }

        if (validityState.valid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            if (feedbackElement) feedbackElement.textContent = 'Looks good!';
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            if (feedbackElement) {
                for (let error in customMessages[input.id]) {
                    if (validityState[error]) {
                        feedbackElement.textContent = customMessages[input.id][error];
                        break;
                    }
                }
            } else {
                console.error(`No feedback element found for input with id '${input.id}'`);
            }
        }
    };

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        let formIsValid = true;

        form.querySelectorAll('input, select').forEach(input => {
            checkValidity(input);
            if (!input.validity.valid) formIsValid = false;
        });

        if (formIsValid) {
            console.log('Form is valid. Submitting...');
            form.submit();
        }
    });

    form.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('input', () => checkValidity(input));
    });
});
