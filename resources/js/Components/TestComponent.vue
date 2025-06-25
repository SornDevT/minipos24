<template lang="">
    <div class=" border border-2 rounded text-center" >
        <h1>test - components</h1>
        <p>
            Number: {{ number }}
        </p>
        <button class=" btn btn-primary" @click="number++">Click</button>
    </div>
</template>
<script>
export default {
    data() {
        return {
            number:0
        }
    },
}
</script>
<style lang="">
    
</style>