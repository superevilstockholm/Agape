<div id="loading-overlay"
    class="position-fixed top-0 start-0 w-100 h-100 d-none justify-content-center align-items-center bg-white bg-opacity-75"
    style="z-index: 1050;">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<script>
    function showLoading() {
        const overlay = document.getElementById('loading-overlay');
        overlay.classList.remove('d-none');
        overlay.classList.add('d-flex');
    }

    function hideLoading() {
        const overlay = document.getElementById('loading-overlay');
        overlay.classList.remove('d-flex');
        overlay.classList.add('d-none');
    }
</script>
