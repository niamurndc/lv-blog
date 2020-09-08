<template>
    <div>
        <Navbar />
        <div class="bland-image">
            <div class="container">
                <router-view></router-view>
            </div>
            
        </div>
    </div>
</template>

<script>
import Navbar from './Navbar'
export default {
    components: {
        Navbar
    },
}
</script>
