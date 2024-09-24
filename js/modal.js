// modal.js
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('voteModal');
    var closeBtn = document.querySelector('.close-btn');
    var voteButtons = document.querySelectorAll('.vote-btn');

    voteButtons.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            var contenderId = this.getAttribute('data-contender');
            // Update modal content based on contenderId
            var modalImage = document.getElementById('modalImage');
            var modalTitle = document.getElementById('modalTitle');

            // Set example data (replace with dynamic data if necessary)
            modalImage.src = `assets/youtuber${contenderId}.jpg`; // Change source according to the clicked contender
            modalTitle.textContent = `Contender ${contenderId}`;
            
            modal.style.display = 'block';
        });
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});