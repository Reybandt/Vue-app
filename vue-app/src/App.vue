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
            <tr v-for="t in times">
                <th scope="row">{{ t }}</th>
                <td v-for="b in blocks">{{ b.text }}</td>
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
                times: 2,
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
                    { text: 'a' },
                    { text: 'b' },
                    { text: 'c' },
                    { text: 'd' },
                    { text: 'e' },
                    { text: 'f' },
                    { text: 'g' }
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
