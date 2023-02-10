<template>
  <div class="friendlistbody">
    <div v-for="item in afterSortList" class="friendrow">
      <div class="sort">{{ item.sort }}</div>
      <div v-for="ite in item.list" class="name_img">
        <img class="userimg" :src="ite.userimg" alt="" />
        <div class="username">
          {{ ite.name }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { getSpell } from "jian-pinyin";
import img1 from "../../static/images/userimg.png";
export default {
  data() {
    return {
      friendlist: [
        {
          userimg: img1,
          name: "张三",
        },
        {
          userimg: img1,
          name: "李三",
        },
        {
          userimg: img1,
          name: "王三",
        },
        {
          userimg: img1,
          name: "赵三",
        },
        {
          userimg: img1,
          name: "赵三",
        },
        {
          userimg: img1,
          name: "赵三",
        },
        {
          userimg: img1,
          name: "赵三",
        },
        {
          userimg: img1,
          name: "艾三",
        },
        {
          userimg: img1,
          name: "A艾三",
        },
      ],
      pylist: [],
      afterSortList: [],
    };
  },
  methods: {
    getFirst() {
      this.friendlist.forEach((item) => {
        var str = item.name;
        var pystr = getSpell(
          str,
          (charactor, spell) => {
            return spell[1];
          },
          ""
        );
        this.pylist.push(pystr);
      });
      this.createNewList();
    },
    createNewList() {
      var friendlist = [];
      friendlist = this.pylist.sort();
      var arr = [];
      friendlist.forEach((item) => {
        arr.push(item.slice(0, 1).toUpperCase());
      });
      var narr = new Set(arr);
      var newfirendlist = [];
      narr.forEach((item) => {
        newfirendlist.push({
          sort: item,
          list: [],
        });
      });
      newfirendlist.forEach((item) => {
        this.friendlist.forEach((ite) => {
          var str = ite.name;
          var pystr = getSpell(
            str,
            (charactor, spell) => {
              return spell[1];
            },
            ""
          );
          if (pystr.slice(0, 1).toUpperCase() == item.sort) {
            item.list.push(ite);
          }
        });
      });
      this.afterSortList = newfirendlist;
    },
  },
  mounted() {
    this.getFirst();
  },
};
</script>

<style scoped>
.friendlistbody {
  height: calc(100vh - 100px);
  overflow-y: auto;
}
.friendlistbody::-webkit-scrollbar {
  width: 0 !important;
}
.friendrow {
  height: auto;
  width: 100%;
  padding: 10px;
  text-align: left;
}
.sort {
  color: #b8b7b7;
  font-size: 14px;
  margin-bottom: 10px;
}
.name_img {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
.userimg {
  width: 50px;
  height: 50px;
}
.username {
  margin-left: 15px;
}
</style>