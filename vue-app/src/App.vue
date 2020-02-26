<template>
    <div id="app" class="container">
        <h2>Ваше расписание</h2>

        <p>
        <span><label><select @change="chooseForm">
          <option
              v-for="s in scheduleOptions"
              :selected="s === defaultOption"
          >{{ s }}
          </option>
        </select></label></span>
            <span></span>
            <span><label><select @change="chooseDate">
          <option
              v-for="s in scheduleOutput"
              :selected="s === defaultOutput"
          >{{ s }}
          </option>
        </select></label></span>
            <span></span>
        </p>
        <table v-if="date === 'week_grid' & type === 'a'" class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" v-for="c in cols">{{ c.text }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in times">
                <th scope="row">{{ item.text }}</th>
                <td v-for="b in blocks">
                    <p v-for="(value, num) in b.day">
                        <span v-if="num === index">
                            {{ value.les }}<br>
                            {{ value.cab }}<br>
                            {{ value.prof}}<br>
                        </span>
                    </p>
                </td>
            </tr>
            </tbody>
        </table>
        <p v-if="type === 'b'">Здесь скоро будет твое персонализированное расписание!</p>
        <p v-if="type === 'c'">Здесь скоро будет твое расписание занятости по педагогам!</p>
        <p v-if="type === 'd'">Здесь скоро будет твое расписание занятости по кабинетам!</p>
    </div>
</template>

<script>
export default {
  data () {
    return {
      type: 'a',
      date: 'week_grid',
      defaultOption: 'общее',
      scheduleOptions: [
        'общее расписание',
        'персонализированное расписание',
        'расписание занятости по педагогам',
        'расписание занятости по кабинетам'
      ],
      defaultOutput: 'каледарь на неделю',
      scheduleOutput: [
        'каледарь на месяц',
        'каледарь на неделю',
        'каледарь на день',
        'список на неделю'
      ],
      times: [
        { text: '10:00-10:45' },
        { text: '10:55-11:40' },
        { text: '11:50-12:35' },
        { text: '12:45-13:30' },
        { text: '13:40-14:25' },
        { text: '14:35-15:20' },
        { text: '15:30-16:15' },
        { text: '16:25-17:10' },
        { text: '17:20-18:05' },
        { text: '18:15-19:00' },
        { text: '19:10-19:55' },
        { text: '20:05-20:50' }
      ],
      cols: [
        { text: 'время' },
        { text: 'понедельник' },
        { text: 'вторник' },
        { text: 'среда' },
        { text: 'четверг' },
        { text: 'пятница' },
        { text: 'суббота' },
        { text: 'воскресенье' }
      ],
      blocks: [
        {
          day: [
            {
              les: 'Авиамоделирование',
              cab: 111,
              prof: 'Иван Игоревич Антонов'
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов'
            }
          ]
        },
        {
          day: [
            {
              les: 'a1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'b1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'c1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'd1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'e1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'f1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'g1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'h1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'i1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'j1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'k1',
              cab: 111,
              prof: 'Степан Иванов'
            },
            {
              les: 'l1',
              cab: 111,
              prof: 'Степан Иванов'
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов'
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов'
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов'
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов'
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов'
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов'
            }
          ]
        }
      ]
    }
  },
  methods: {
    chooseForm (event) {
      if (event.target.value === this.scheduleOptions[1]) {
        this.type = 'b'
      } else if (event.target.value === this.scheduleOptions[2]) {
        this.type = 'c'
      } else if (event.target.value === this.scheduleOptions[3]) {
        this.type = 'd'
      } else {
        this.type = 'a'
      }
    },
    chooseDate (event) {
      if (event.target.value === this.scheduleOutput[0]) {
        this.date = 'month'
      } else if (event.target.value === this.scheduleOutput[2]) {
        this.date = 'day'
      } else if (event.target.value === this.scheduleOutput[3]) {
        this.date = 'week_list'
      } else {
        this.date = 'week_grid'
      }
    }
  }
}
</script>
<style scoped>
    #app {
        color: darkblue;
    }

    span {
        margin-right: 10px;
    }

    p {
        color: black;
    }
</style>
