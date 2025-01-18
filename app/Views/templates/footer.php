
    <!-- Footer -->
    <footer class="text-center py-5 bg-dark text-light">
        <p>&copy; 2025 EcoEducar. Todos os direitos reservados.</p>
    </footer>

    <!-- Back to Top -->
    <div class="back-to-top">        
        <a href="#" class="btn btn-lg btn-custom btn-lg-square rounded-circle"><i class="bi bi-arrow-up" style="font-size: 1.25rem;"></i></a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <script>
        // Back to top button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').fadeIn('slow');
            } else {
                $('.back-to-top').fadeOut('slow');
            }
        });
        $('.back-to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
            return false;
        });
    </script>
</body>
</html>