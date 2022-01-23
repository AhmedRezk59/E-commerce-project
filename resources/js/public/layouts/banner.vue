<template>
    <div>
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white text-header">
                    <h1 class="display-3 fw-bold text-light font-weight mb-0">
                        Ecommerce Market
                    </h1>
                    <h3 class="display-4 fw-bold">
                        Shop in style
                    </h3>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
header {
    background-image: url("/img/banner.jpg");
    background-size: cover;
    background-position: top top;
    height: 600px;
    position: relative;
}
.text-header {
    transform: translate(-50%, -50%);
    position: absolute;
    top: 50%;
    left: 30%;
}
</style>
