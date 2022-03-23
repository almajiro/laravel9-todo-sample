<template>
    <v-app>
        <v-app-bar color="primary" dark app>
            <v-toolbar-title>Laravel + Vue.js ToDo App</v-toolbar-title>
            <v-spacer></v-spacer>

            <!-- Create Modal -->
            <v-dialog v-model="form.show" width="500">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn dark v-bind="attrs" v-on="on" :loading="isLoading">
                        <v-icon>mdi-plus</v-icon> ToDoを作成
                    </v-btn>
                </template>

                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        ToDoを作成
                    </v-card-title>

                    <v-container>
                        <v-card-text>
                            ToDoを追加します。
                        </v-card-text>
                        <v-row>
                            <v-col cols="8" offset="2">
                                <v-text-field v-model="form.todo" label="Enter what do you want to do." required></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="warning" text v-on:click="form.show = false">閉じる</v-btn>
                        <v-btn color="primary" text v-on:click="createToDo">作成</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

        </v-app-bar>

        <v-main>
            <v-container>
                <h4>ToDo 一覧</h4>
                <!-- ToDo List Table -->
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                        <tr>
                            <th class="text-left">ToDo</th>
                            <th class="text-left">作成日</th>
                            <th class="text-right">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(todo, i ) in todos" :key="i">
                            <td>{{ todo.todo}}</td>
                            <td>{{ format(new Date(todo.created_at), 'yyyy-MM-dd') }}</td>
                            <td class="text-right">
                                <v-btn color="warning" fab x-small dark v-on:click="deleteToDo(todo.id)">
                                    <v-icon>mdi-trash-can</v-icon>
                                </v-btn>
                            </td>
                        </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-container>
        </v-main>

        <v-footer color="primary" dark app>
            <v-icon>mdi-wrench</v-icon> Coded by @almajiro
        </v-footer>
    </v-app>
</template>

<script>
import { format } from 'date-fns'
import todo from "../datastore/todo";

export default {
    data() {
        return {
            'isLoading': false,
            'todos': [],
            'total': 0,

            'form': {
                'show': false,
                'todo': null,
            },

            format
        }
    },

    mounted() {
        console.log('ToDo component successfully mounted.');
        this.reloadList();
    },

    methods: {
        reloadList: async function () {
            this.isLoading = true;

            const data = await todo.getAll();
            this.todos = data.todos;
            this.total = data.total;

            this.isLoading = false;
        },

        createToDo: async function () {
            this.isLoading = true;

            await todo.create(this.form.todo);
            this.form.todo = null;

            this.form.show = false;
            await this.reloadList();
        },

        deleteToDo: async function (toDoId) {
            await todo.delete(toDoId);
            await this.reloadList();
        }
    }
}
</script>
