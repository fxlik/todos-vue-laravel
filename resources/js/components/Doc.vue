<template>
    <!-- <div class="flex-center position-ref full-height"> -->
        <div class="content">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <input type="text" name="addTodo" class="todo-input" id="addTodo" placeholder="Mau ngapain lu?" v-model="newTodo" @keyup.enter="addTodo">
                <transition-group name="fade" enter-active-class="animated bounceInDown" leave-active-class="animated fadeOutLeft">
                <todo-item v-for="(todo, index) in todosFiltered" :key="todo.id" :todo="todo" :index="index" :checkAll="!anyRemaining" @removedTodo="removeTodo" @finishedEdit="finishedEdit">
                    <!-- TodoItem.vue Here -->
                </todo-item>
                </transition-group>

                <div class="extra-container">
                    <div><label><input type="checkbox" :checked="!anyRemaining" @change="checkAllTodos"> Check All</label></div>
                    <div>{{ remaining }} Item Left</div>
                </div>

                <div class="extra-container">
                    <div>
                        <button :class="{active: filter == 'all'}" @click="filter = 'all'">All</button>
                        <button :class="{active: filter == 'active'}" @click="filter = 'active'">Active</button>
                        <button :class="{active: filter == 'completed'}" @click="filter = 'completed'">Completed</button>
                    </div>

                    <div>
                        <transition name="fade">
                        <button v-if="showClearCompletedButton" @click="clearCompleted">Clear Completed</button>
                        </transition>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    <!-- </div> -->
</template>

<script>
import TodoItem from "./TodoItem"

export default {
    name: 'todo-list',
    components:{
        TodoItem,
    },
    data(){
        return {
            newTodo: '',
            idForTodo: 3,
            beforeEditCache: '',
            filter: 'all',
            hargaBeras: 50000,
            todos: [
                {
                    'id': 1,
                    'title': 'Makan nasi padang',
                    'completed': false,
                    'editing': false,
                },
                {
                    'id': 2,
                    'title': 'Cuci piring bersih',
                    'completed': false,
                    'editing': false,
                },
            ]
        }
    },
    computed: {
        remaining(){
            return this.todos.filter(todo => !todo.completed).length
        },
        anyRemaining(){
            return this.remaining != 0
        },
        todosFiltered(){
            if (this.filter == 'all') {
                return this.todos
            } else if (this.filter == 'active') {
                return this.todos.filter(todo => !todo.completed)
            } else if (this.filter == 'completed') {
                return this.todos.filter(todo => todo.completed)
            }

            return this.todos
        },
        showClearCompletedButton(){
            return this.todos.filter(todo => todo.completed).length > 0
        }

    },
    methods: {
        hai: function(time){
            return 'Good ' + time + ' ' + this.title;
            // this.data.hargaBeras;
        },
        diskonYa: function(){
            this.hargaBeras = 25000;
        },
        addTodo(){
            if (this.newTodo.trim() == 0) {
                return
            }

            this.todos.push({
                id: this.idForTodo,
                title: this.newTodo,
                completed: false,
                editing: false,
            })

            this.newTodo = '',
            this.idForTodo++
        },
        removeTodo(index){
            this.todos.splice(index, 1) 
        },
        checkAllTodos(){
            this.todos.forEach((todo) => todo.completed = event.target.checked)
        }, 
        clearCompleted(){
            this.todos = this.todos.filter(todo => !todo.completed)
        },
        finishedEdit(data){
            this.todos.splice(data.index, 1, data.todo)
        }
        
    }
}
</script>

<style lang="scss">
@import url("https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css");

.content{
    font-size: 24px;
}
.todo-input{
    width: 100%;
    padding: 10px 18px;
    font-size: 18px;
    margin-top: 10px;
    margin-bottom: 16px;
    &:focus {
        outline: 0;
    }
}
.todo-item{
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    animation-duration: 0.3s;
}

.remove-item{
    cursor: pointer;
    margin-left: 14px;
    &:hover {
        color: black;
    }
}

.todo-item-left{
    display: flex;
    align-items: center;
}

.todo-item-label{
    padding: 10px;
    border: 1px solid white;
    margin-left: 12px;
}

.todo-item-edit{
    font-size: 24px;
    color: rgb(94, 94, 94);
    margin-left: 12px;
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    font-family: Arial, Helvetica, sans-serif;

    &:focus{
        outline: none;
    }
}

.completed{
    text-decoration: line-through;
    color: grey;
}

.extra-container{
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 16px;
    border-top: 1px solid lightgray;
    padding-top: 14px;
    margin-bottom: 14px;
}
button {
    font-size: 14px;
    background-color: white;
    appearance: none;
    border-radius: 10px;

    &:hover {
        background: #57bf97;
    }

    &:focus {
        outline: none;
    }
}

.active{
    background: #57bf97;
}

.fade-enter-active, .fade-leave-active{
    transition: opacity .3s;
}

.fade-enter, .fade-leave-to{
    opacity: 0;
}
</style>


