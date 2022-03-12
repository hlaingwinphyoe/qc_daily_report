


</div>
</div>
</section>
<script src="<?php echo $url; ?>/assets/vendor/jquery/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="<?php echo $url; ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url; ?>/assets/vendor/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo $url; ?>/assets/vendor/datatable/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo $url; ?>/assets/js/app.js"></script>
<script>
    let currentLocation = location.href;
    let links = document.querySelectorAll(".menu-item-link");
    let menuLength = links.length;

    for (let i=0; i<menuLength;i++){
        if (links[i].href ===currentLocation){
            links[i].classList = "currentPage";
        }
    }
</script>

</body>
</html>