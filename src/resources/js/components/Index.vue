<template>
    <div>
        <v-content>
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <p class="title">
                            YonezuMorseGenerator
                        </p>
                        <v-text-field
                            type="text"
                            v-model="enter_words"
                            label="Enter phrase here"
                            :rules="[rules.required]"
                        />
                        <template v-if="words && codes">
                            <v-card outlined>
                                <v-list dense>
                                    <v-list-item>
                                        <v-list-item-content>
                                            <v-list-item-subtitle v-html="'Input:'"></v-list-item-subtitle>
                                            <v-list-item-title v-html="words"></v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item-content>
                                            <v-list-item-subtitle v-html="'Output:'"></v-list-item-subtitle>
                                            <v-list-item-title v-html="codes"></v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                                <v-card-actions>
                                    <v-btn @click="twitterShare()" depressed block class="white--text" color="#1DA1F2">
                                        <v-icon>mdi-twitter</v-icon>
                                        Share
                                    </v-btn>
                                </v-card-actions>
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
                var url = `https://twitter.com/intent/tweet?text=${this.codes}`;
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