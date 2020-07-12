<template>
    <div>
        <v-dialog v-model="showList" max-width="500px">
            <v-card>
                <v-card-text class="pa-4">
                    <p class="title font-weight-bold text--primary ma-0">
                        対応表
                        <v-btn icon absolute right @click="showList = false"><v-icon>mdi-close</v-icon></v-btn>
                    </p>
                    <v-list dense>
                        <template v-for="(code, index) in codeList">
                            <v-list-item :key="`code-${index}`">
                                <v-list-item-content>{{ code.word }}</v-list-item-content>
                                <v-list-item-content class="align-end">{{ code.code }}</v-list-item-content>
                            </v-list-item>
                            <v-divider
                                v-if="index + 1 < codeList.length"
                                :key="`divider-${index}`"
                                class="ma-0"
                            />
                        </template>
                    </v-list>
                </v-card-text>
                <v-card-actions>
                    <v-btn block @click="showList = false">close</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-content>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <p class="title">
                            YonezuMorseGenerator | 米津玄師のモールス信号生成サイト
                        </p>
                        <v-btn block @click.stop="showList = !showList" class="mb-4">
                            モールス信号の対応表はこちら
                        </v-btn>
                        <p>
                            半角英数字の入力のみ有効となります。(Only single-byte alphanumeric characters are allowed.)
                        </p>
                        <v-text-field
                            type="text"
                            outlined
                            v-model="enter_words"
                            label="Enter phrase here"
                            :rules="[rules.required]"
                        />
                        <template v-if="words && codes">
                            <v-card outlined class="pa-3">
                                <p class="font-weight-bold">Input:</p>
                                <p>{{ words }}</p>
                                <p class="font-weight-bold">Output:</p>
                                <p>{{ codes }}</p>    
                                <v-card-actions>
                                    <v-btn @click="twitterShare()" depressed block class="white--text" color="#1DA1F2">
                                        <v-icon>mdi-twitter</v-icon>
                                        Share
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                        <template v-else>
                            <v-card outlined class="pa-3">
                                <p class="font-weight-bold">404 NOT FOUND</p>
                                <p>Sorry, you're straysheep. That's all we know.</p>
                            </v-card>
                        </template>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                codeList: [],
                showList: false,
                enter_words: '',
                codes: '',
                rules: {
                    required: value => !!value || 'Phrase is required',
                },
            }
        },
        computed: {
            words: function() {
                return this.enter_words.toUpperCase();
            }
        },
        methods: {
            getList: async function() {
                axios.get('/get/getList')
                    .then(res => {this.codeList = res.data});
            },
            generate: async function() {
                var return_codes = await axios.post('get/generate', {
                    words: this.words,
                });
                this.codes = return_codes.data;
            },
            twitterShare: function() {
                var url = `https://twitter.com/intent/tweet?text=${this.codes}&url=https://yonezu-morse-generator.herokuapp.com/`;
                window.open(url, '_blank', 'noopener');
            }
        },
        watch: {
            words: function() {
                this.generate();
            }
        },
        created () {
            this.getList();
        }
    }
</script>