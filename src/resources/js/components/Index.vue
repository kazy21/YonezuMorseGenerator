<template>
    <div>
        <v-content>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <p class="title">
                            YonezuMorseGenerator
                        </p>
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
        }
    }
</script>