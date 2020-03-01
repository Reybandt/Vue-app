<template>
    <div id="app" class="container pt-5">
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
                <th scope="row">{{ item }}</th>
                <td v-for="b in blocks">
                    <p v-for="(value) in b.day">
                        <span v-if="value.num === index">
                            <strong>{{ value.les }}</strong><br>
                            <em style="color: lightslategrey">каб. {{ value.cab }}</em><br>
                            <u  style="color: lightslategrey">{{ value.prof}}</u><br>
                        </span>
                    </p>
                </td>
            </tr>
            </tbody>
        </table>
        <ul v-if="date === 'week_list' & type === 'a'" class="schedule">

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center color-red">
                    <router-link
                        tag="li"
                        class="page-item"
                        :to="{name: '', query: {week_day: cols[counter + 1].text, block: blocks[counter].day}}">
                        <a class="page-link">Пн</a>
                    </router-link>
                    <router-link
                        tag="li"
                        class="page-item"
                        :to="{name: '', query: {week_day: cols[counter + 2].text, block: blocks[counter + 1].day}}">
                        <a class="page-link">Вт</a>
                    </router-link>
                    <router-link
                        tag="li"
                        class="page-item"
                        :to="{name: '', query: {week_day: cols[counter + 3].text, block: blocks[counter + 2].day}}">
                        <a class="page-link">Ср</a>
                    </router-link>
                    <router-link
                        tag="li"
                        class="page-item"
                        :to="{name: '', query: {week_day: cols[counter + 4].text, block: blocks[counter + 3].day}}">
                        <a class="page-link">Чт</a>
                    </router-link>
                    <router-link
                        tag="li"
                        class="page-item"
                        :to="{name: '', query: {week_day: cols[counter + 5].text, block: blocks[counter + 4].day}}">
                        <a class="page-link">Пт</a>
                    </router-link>
                    <router-link
                        tag="li"
                        class="page-item"
                        :to="{name: '', query: {week_day: cols[counter + 6].text, block: blocks[counter + 5].day}}">
                        <a class="page-link">Сб</a>
                    </router-link>
                    <router-link
                        tag="li"
                        class="page-item"
                        :to="{name: '', query: {week_day: cols[counter + 7].text, block: blocks[counter + 6].day}}">
                        <a class="page-link">Вс</a>
                    </router-link>
                </ul>
            </nav>

            <h5 class="container text-center pb-4 pt-4"> {{ $route.query.week_day }}</h5>

            <li v-for="value in  $route.query.block" >
                    <div v-for="(item, index) in times" class="schedule_day">
                        <span v-if="value.num === index">
                            <em style="color: darkblue">{{ item }}</em>
                            <div class="container text-center">
                                <strong>{{ value.les }}</strong><br>
                                <em
                                    style="color: lightslategrey;
                                    padding-right: 15px"
                                >
                                    каб. {{ value.cab }}
                                </em><br>
                                <u  style="color: lightslategrey">{{ value.prof}}</u><br>
                                <hr>
                            </div>
                        </span>
                    </div>
            </li>
        </ul>
        <p v-if="type === 'b'">Здесь скоро будет твое персонализированное расписание!</p>
        <p v-if="type === 'c'">Здесь скоро будет твое расписание занятости по педагогам!</p>
        <p v-if="type === 'd'">Здесь скоро будет твое расписание занятости по кабинетам!</p>
    </div>
</template>

<script>
export default {
  data () {
    return {
      counter: 0,
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
        '10:00-10:45',
        '10:55-11:40',
        '11:50-12:35',
        '12:45-13:30',
        '13:40-14:25',
        '14:35-15:20',
        '15:30-16:15',
        '16:25-17:10',
        '17:20-18:05',
        '18:15-19:00',
        '19:10-19:55',
        '20:05-20:50'
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
              les: 'Е-текстиль',
              cab: 319,
              prof: 'Королева Т. Н.',
              num: 3
            },
            {
              les: 'Е-текстиль',
              cab: 319,
              prof: 'Королева Т. Н.',
              num: 4
            },
            {
              les: 'Е-текстиль',
              cab: 319,
              prof: 'Королева Т. Н.',
              num: 5
            },
            {
              les: 'Юный конструктор Lego',
              cab: 202,
              prof: 'Любимова В. В.',
              num: 6
            },
            {
              les: 'Юный конструктор Lego',
              cab: 202,
              prof: 'Любимова В. В.',
              num: 7
            },
            {
              les: 'Инженер PRO (образ.пакет): инженерное 3d моделирование и прототипирование',
              cab: 319,
              prof: 'Рытов А. М.',
              num: 8
            },
            {
              les: 'Инженер PRO (образ.пакет): программирование микроконтроллеров',
              cab: 325,
              prof: 'Королева Т. Н.',
              num: 8
            },
            {
              les: 'Интернет вещей',
              cab: 117,
              prof: 'Эрлеман П. И.',
              num: 8
            },
            {
              les: 'Инженер PRO (образ.пакет): инженерное 3d моделирование и прототипирование',
              cab: 319,
              prof: 'Рытов А. М.',
              num: 9
            },
            {
              les: 'Инженер PRO (образ.пакет): программирование микроконтроллеров',
              cab: 325,
              prof: 'Королева Т. Н.',
              num: 9
            },
            {
              les: 'Интернет вещей',
              cab: 117,
              prof: 'Эрлеман П. И.',
              num: 9
            },
            {
              les: 'Инженер PRO (образ.пакет): инженерное 3d моделирование и прототипирование',
              cab: 319,
              prof: 'Рытов А. М.',
              num: 10
            },
            {
              les: 'Киберэлектроника',
              cab: 325,
              prof: 'Черкасов Т. М.',
              num: 10
            },
            {
              les: 'Интернет вещей (проектная деятельность)',
              cab: 117,
              prof: 'Эрлеман П. И.',
              num: 10
            },
            {
              les: 'Инженер PRO (образ.пакет): инженерное 3d моделирование и прототипирование',
              cab: 319,
              prof: 'Рытов А. М.',
              num: 11
            },
            {
              les: 'Киберэлектроника',
              cab: 325,
              prof: 'Черкасов Т. М.',
              num: 11
            }
          ]
        },
        {
          day: [
            {
              les: 'Авиамоделирование',
              cab: 111,
              prof: 'Иван Игоревич Антонов',
              num: 0
            },
            {
              les: 'Web-дизайн',
              cab: 435,
              prof: 'Александр Андреевич Сомов',
              num: 0
            },
            {
              les: 'b1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 1
            },
            {
              les: 'c1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 2
            },
            {
              les: 'd1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 3
            },
            {
              les: 'e1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 4
            },
            {
              les: 'f1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 5
            },
            {
              les: 'g1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 6
            },
            {
              les: 'h1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 7
            },
            {
              les: 'i1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 8
            },
            {
              les: 'j1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 9
            },
            {
              les: 'k1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 10
            },
            {
              les: 'l1',
              cab: 111,
              prof: 'Степан Иванов',
              num: 11
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов',
              num: 0
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов',
              num: 1
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов',
              num: 2
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов',
              num: 3
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов',
              num: 4
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов',
              num: 5
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов',
              num: 6
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов',
              num: 7
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов',
              num: 8
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов',
              num: 9
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов',
              num: 10
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов',
              num: 11
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов',
              num: 0
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов',
              num: 1
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов',
              num: 2
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов',
              num: 3
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов',
              num: 4
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов',
              num: 5
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов',
              num: 6
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов',
              num: 7
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов',
              num: 8
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов',
              num: 9
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов',
              num: 10
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов',
              num: 11
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов',
              num: 0
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов',
              num: 1
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов',
              num: 2
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов',
              num: 3
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов',
              num: 4
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов',
              num: 5
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов',
              num: 6
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов',
              num: 7
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов',
              num: 8
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов',
              num: 9
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов',
              num: 10
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов',
              num: 11
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов',
              num: 0
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов',
              num: 1
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов',
              num: 2
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов',
              num: 3
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов',
              num: 4
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов',
              num: 5
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов',
              num: 6
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов',
              num: 7
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов',
              num: 8
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов',
              num: 9
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов',
              num: 10
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов',
              num: 11
            }
          ]
        },
        {
          day: [
            {
              les: 'a',
              cab: 111,
              prof: 'Иван Антонов',
              num: 0
            },
            {
              les: 'b',
              cab: 111,
              prof: 'Иван Антонов',
              num: 1
            },
            {
              les: 'c',
              cab: 111,
              prof: 'Иван Антонов',
              num: 2
            },
            {
              les: 'd',
              cab: 111,
              prof: 'Иван Антонов',
              num: 3
            },
            {
              les: 'e',
              cab: 111,
              prof: 'Иван Антонов',
              num: 4
            },
            {
              les: 'f',
              cab: 111,
              prof: 'Иван Антонов',
              num: 5
            },
            {
              les: 'g',
              cab: 111,
              prof: 'Иван Антонов',
              num: 6
            },
            {
              les: 'h',
              cab: 111,
              prof: 'Иван Антонов',
              num: 7
            },
            {
              les: 'i',
              cab: 111,
              prof: 'Иван Антонов',
              num: 8
            },
            {
              les: 'j',
              cab: 111,
              prof: 'Иван Антонов',
              num: 9
            },
            {
              les: 'k',
              cab: 111,
              prof: 'Иван Антонов',
              num: 10
            },
            {
              les: 'l',
              cab: 111,
              prof: 'Иван Антонов',
              num: 11
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
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .schedule_day {
        color: black;
    }
</style>
