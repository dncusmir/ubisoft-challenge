<template>
    <div id="matches-table">
        <div v-for="match in matches" :key="match.id" class="media text-muted pt-3">
            <div class="row media-body mx-4 pb-3 mb-0 lh-125 border-bottom border-gray">
                <div class="col-lg-5 text-right">
                    <strong>
                        <a
                            @click.prevent="addBet(match.id, 'home', match.bet)"
                            :class="{'text-success':match.bet == 'home'}" href="">{{match.home}}</a>
                    </strong>
                </div>
                <div class="col-lg-2 text-center">
                    <span>vs</span>
                </div>
                <div class="col-lg-5 text-left">
                    <strong>
                        <a
                            @click.prevent="addBet(match.id, 'away', match.bet)"
                            :class="{'text-success':match.bet == 'away'}" href="">{{match.away}}</a>
                    </strong>
                </div>
                
                <div v-if="match.bet !== null" class="w-100 mt-1 text-center">
                    You bet {{bet}} on {{match[match.bet]}}.
                    <button v-if="canBet" @click="cancelBet(match.id)" class="btn btn-danger btn-sm">Cancel bet</button>
                </div>
                <div v-if="!canBet" class="w-100 mt-1 text-center">
                    <span v-if="user > -1">{{match[results[match.id]]}} won the match.</span>
                    <span v-if="match.bet !== null && results[match.id] === match.bet" class="text-success">You gain {{bet}} points.</span>
                    <span v-else-if="match.bet !== null && results[match.id] !== match.bet" class="text-danger">You lost {{bet}} points.</span>
                </div>
            </div>
        </div>
        <div v-if="canBet" class="text-center mt-3">
            <button @click="generateResults" class="btn btn-primary">Generate results</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MatchesTable',
    props: {
        matches: Array,
        bet: Number,
        canBet: Boolean,
        results: Array
    },
    
    methods: {
        cancelBet(id) {
            this.$emit('cancel:bet', id)
        },
        addBet(id, team, bet) {
            if (!this.canBet) return
            if (team === bet) return
            let sameMatch = (bet === null) ? false : true
            this.$emit('add:bet', id, team, sameMatch)
        },
        generateResults() {
            this.$emit('generate:results')
        }
    }
}
</script>