<template>
    <div>
        <v-app>
            <transition mode="out-in">
                <router-view></router-view>
            </transition>
        </v-app>
    </div>
</template>

<style scoped>	
.v-enter-active, .v-leave-active {
    transition: opacity .5s;
}
.v-enter, .v-leave-to {
    opacity: 0;
}
</style>