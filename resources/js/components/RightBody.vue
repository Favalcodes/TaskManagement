<template>
  <div id="right">
      <h1>Development RetailManagement</h1>

    <div class="horizontal">
        <img :src="require('../images/horizontal.png').default" />
    </div>

    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic natus, itaque veritatis amet provident sit officia nobis distinctio saepe veniam sed unde quibusdam earum, in soluta, esse fugiat sunt dicta!
    </p>

    <div class="users-icon"><img :src="require('../images/users.png').default" /></div>

    <div class="tasks">
        <div class="add-task">
            <h2>Today's Task</h2>

            <div class="add-action">
                <img :src="require('../images/add.png').default" alt="">
            </div>
        </div>

        <ul class="tasks-list">
            <li v-for="task in todayTask" v-bind:key="task.id">
                <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input type="checkbox" name="test" :checked="task.completed" @change="updateTodayTask(task.taskId)">
                                <span></span>
                            </label>

                            <h4>{{task.title}}</h4>
                        </div>

                        <div class="right">
                            <img :src="require('../images/edit.png').default" alt="">
                            <img :src="require('../images/del.png').default" @click="deleteTask(task.taskId)">

                            <button
                v-bind:class="{
                  inprogress: !task.approved,
                  approved: task.approved,
                }"
              >
                {{ task.approved ? "Approved" : "In progress" }}
              </button>
                        </div>
                    </div>
            </li>
        </ul>
    </div>

    <div class="upcoming">
        <div class="add-tasks">
            <h2>Upcoming</h2>

            <div class="add-action">
                <img :src="require('../images/add.png').default" alt="">
            </div>
        </div>
            <form action="" @submit="addUpcomingTask">
                <input type="text" v-model="newTask">
            </form>

            <ul class="tasks-list">
                <li v-for="upcomingTask in upcoming" v-bind:key="upcomingTask.id">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input type="checkbox" name="test" :checked="upcomingTask.completed" @change="checkUpcoming(upcomingTask.taskId)">
                                <span></span>
                            </label>

                            <h4>{{upcomingTask.title}}</h4>
                        </div>

                        <div class="right">
                            <img :src="require('../images/edit.png').default" alt="">
                            <img :src="require('../images/del.png').default" @click="delUpcoming(upcomingTask.taskId)">

                            <button v-bind:class="{
                                inprogress: !upcoming.waiting
                                }">
                                Waiting</button>
                        </div>
                    </div>
                </li>
            </ul>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return{
            todayTask: [],
            upcoming: [],
            newTask: "",
        };
    },

    created() {
        this.fetchTodayTask();
        this.fetchupcoming();
    },

    methods: {
        // Upcoming Tasks

        // Get upcoming tasks
        fetchupcoming() {
            fetch('/api/upcoming')
            .then((res) => res.json())
            .then(({data}) => {
                this.upcoming = data;
            }).catch((err) => console.log(err));
        },

        // Add upcoming tasks
        addUpcomingTask(e) {
            e.preventDefault();

            if(this.upcoming.length > 4){
                alert('Please complete all upcoming tasks')
            }else{
                const newTask = {
                    title: this.newTask,
                    waiting: true,
                    taskId: Math.random().toString(36).substring(7),
                };

                // Post request
                fetch('/api/upcoming', {
                    method: 'Post',
                    headers: {
                        "content-type": "application/json"
                    },
                    body: JSON.stringify(newTask),

                }).then(() => this.upcoming.push(newTask))
                .catch((err) => console.log(err));

                // clear or reset new task
                this.newTask = "";
            }
        },

        // Delete upcoming task
        delUpcoming(taskId){
            if(confirm("Are you sure?")){
                fetch(`/api/upcoming/${taskId}`, {
                    method: 'delete',
                }).then((res) => res.json())
                .then(() => {
                    this.upcoming = this.upcoming.filter(
                        ({taskId: id}) => id !== taskId
                    );
                }).catch((err) => console.log(err));
            }

        },

        // check upcoming tasks
            checkUpcoming(taskId) {
                if(this.todayTask.length > 4) {
                    alert('Sorry complete all existing tasks');
                    window.location.href= '/';
                }else{
                    this.addDailyTask(taskId);

                    // Delete the task from db
                    fetch(`/api/upcoming/${taskId}`, {
                        method: 'delete'
                    }).then((res) => res.json())
                    .then(() => {
                        this.upcoming = this.upcoming.filter(({taskId: id}) => id !== taskId)
                    })
                }
            },

        // Today Task

        // Get today's tasks
        fetchTodayTask() {
            fetch('/api/dailytask', {
                method: 'get'
            }).then((res) => res.json())
            .then(({data}) => {
                this.todayTask = data;
                })
            .catch((err) => console.log(err));
        },


        // Add daily task
        addDailyTask(taskId){
            // get task
            const task = this.upcoming.filter(({taskId: id}) => id == taskId)[0];

            // Make a post request
            fetch(`/api/dailytask`, {
                method: 'POST',
                headers: {
                    "content-type": 'application/json'
                },
                body: JSON.stringify(task)
            }).then(() => this.todayTask.unshift(task))
            .catch((err) => console.log(err));
        },

        // update today task
        updateTodayTask(taskId){
            if(confirm('Task completed?')){
                fetch(`/api/dailytask/${taskId}`, {
                    method: 'delete'
                }).then(() => {})
                .then(() =>
                    this.todayTask = this.todayTask.filter(({taskId: id}) => id !== taskId)
                )
                .catch((err) => console.log(err));
            }
        },

        // Delete today task
        deleteTask(taskId){
            if(confirm('Are you sure?')){
            fetch(`/api/dailytask/${taskId}`, {
                method: 'delete'
            }).then((res) => res.json())
            .then(() => this.todayTask = this.todayTask.filter(({taskId: id}) => id !== taskId))
            .catch((err) => console.log(err));
            }
        }
    }
}
</script>

<style>

</style>
