import confetti from './node_modules/canvas-confetti/dist/confetti.module.mjs';

const confettiButton = document.getElementById('confetti-button');

confettiButton.addEventListener('click', () => {
    confetti({
        particleCount: 150,
        spread: 90,
        origin: { y: 0.6 }
    });
});