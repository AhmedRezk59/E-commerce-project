<template>
    <div class="container-fluid">
        <!-- 404 Error Text -->
        <div class="text-center not-found">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">
                It looks like you found a glitch in the matrix...
            </p>
            <router-link :to="{ name: 'Main' }"
                >&larr; Back to Main page</router-link
            >
        </div>
    </div>
</template>

<style scoped>
.not-found {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
