
<template>

        <div>
            <h1>Menu</h1>
         </div>
   
</template>
<script setup>
import axios from 'axios'
import { onMounted, ref } from 'vue'
  import { useCounterStore } from "../stores/counter";
    const main = useCounterStore()
     main.tokenSet = true
  

</script>