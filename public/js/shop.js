
document.addEventListener('DOMContentLoaded', function () {
    const toasts = document.querySelectorAll('[id^="toast-"]');

    toasts.forEach(toast => {
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');

            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 3000);
    });
});
