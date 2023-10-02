<style>
#loader {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.loader-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

.loader-text {
    font-size: 24px;
    color: white;
}
</style>
<div id="loader">
    <div class="loader-content">
        <span class="loader-text">Cargando...</span>
        <div class="loader-spinner"></div>
    </div>
</div>