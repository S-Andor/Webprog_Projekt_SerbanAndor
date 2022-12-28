<template>
  <v-list three-line>
    <template v-for="(item, index) in transactions">
      <span
          class="mx-auto font-weight-bold"
          v-if="item.header"
          :key="item.header"
          v-text="item.header"
      ></span>

      <v-card
          class="mx-auto my-2"
          v-else
          :key="item.id"
          style="max-width: 350px">
        <v-container>
          <v-row>
            <v-col> <v-icon style="font-size: 35px">
              mdi-{{ item.icon }}
            </v-icon></v-col>
            <v-col>
              <span > {{item.name}}</span>
            </v-col>
            <v-col>
              <span :class="item.type === transactionTypes.INCOME ? 'green--text' : 'red--text'">{{item.type === transactionTypes.INCOME ? '+' : '-'}} {{ item.amount }}</span>
            </v-col>
          </v-row>

        </v-container>

      </v-card>

    </template>
  </v-list>
</template>

<script>
import {transactionTypes} from "@/enums/transactionTypes";
export default {
  name: "transactions-list",
  components:{
    transactionTypes
  },
  props:{
    transactions:{
      type:Array,
      required: true
    }
  },
  data(){
    return{
      transactionTypes
    }
  },
}
</script>

<style scoped>

</style>