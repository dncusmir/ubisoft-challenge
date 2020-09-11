<template>
    <div id="tournament-show" :class="{'loading': loading}">
        <div class="d-flex align-items-center p-3 my-3 text-black-50 bg-warning rounded box-shadow">
            {{ tournamentName }}
        </div>
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="d-flex justify-content-between border-bottom border-gray pb-2 mb-0">
                <h6 class="">Matches: {{ matches.length }}</h6>
                <h6 v-if="user == -1">You need to log in to bet.</h6>
                <h6 v-else>Points: {{ points }} / {{ initialPoints }}</h6>
            </div>

            <matches-table
                :matches="matches"
                :bet="bet"
                :canBet="canBet"
                :results="results"
                @cancel:bet="cancelBet"
                @add:bet="addBet"
                @generate:results="generateResults"
                ></matches-table>
            
            <div v-if="!canBet" class="w-100 text-center">
                You now have {{points}} points.
            </div>
        </div>
    </div>
</template>

<script>
    import MatchesTable from './MatchesTable.vue'

    export default {
        name: 'TournamentShow',
        components: {
            MatchesTable
        },
        props: {
            id: Number,
            user: Number
        },

        data() {
            return {
                points: 0,
                initialPoints: 0,
                bet: 10,
                canBet: true,
                tournamentName: '',
                matches: [],
                results: [],
                tournamentLoaded: false,
                matchesLoaded: false,
                userLoaded: false,
            }
        },

        computed: {
            loading() {
                if (this.user == -1) {
                    return !this.tournamentLoaded || !this.matchesLoaded
                } 

                return !this.tournamentLoaded || !this.matchesLoaded || !this.userLoaded
            }
        },

        methods: {
            async getTournamentInfo(id) {
                try {
                    const response = await axios.get('/api/tournaments/' + id)
                    this.tournamentName = response.data.data.name
                    this.tournamentLoaded = true
                } catch(error) {
                    console.error(error)
                }
            },
            
            async getMatches(id) {
                try {
                    const response = await axios.get('/api/tournaments/' + id + '/games')
                    this.matches = response.data.data
                    this.matches.forEach(element => element.bet = null)
                    this.matchesLoaded = true
                } catch(error) {
                    console.error(error)
                }
            },
            
            async getUserInfo(user) {
                try {
                    const response = await axios.get('/api/users/' + user)
                    this.points = response.data.data.points
                    this.initialPoints = this.points
                    this.userLoaded = true
                } catch(error) {
                    console.error(error)
                }
            },

            async updateUserPoints(user, points) {
                try {
                    let response = await axios.patch('/api/users/' + user, {
                        points: this.points
                    })
                } catch (error) {
                    console.error(error)
                }
            },

            cancelBet(id) {
                this.points += this.bet
                this.matches = this.matches.map(match => {
                    let updatedMatch = match
                    if (match.id === id) {                    
                        updatedMatch.bet = null
                    }
                    return updatedMatch
                })
            },

            addBet(id, team, sameMatch) {
                
                if (!sameMatch && this.points < this.bet) {
                    alert('not enough points to bet')
                    return
                }

                if (!sameMatch) this.points -= this.bet

                this.matches = this.matches.map(match => {
                    let updatedMatch = match
                    if (match.id === id) {                    
                        updatedMatch.bet = team
                    }
                    return updatedMatch
                })
            },

            generateResults() {
                this.canBet = false

                this.matches.forEach(match => {
                    let i = Math.floor(Math.random() * Math.floor(2));
                    let team = (i == 0) ? 'home' : 'away'

                    this.results[match.id] = team

                    if (team === match.bet) this.points += 2 * this.bet
                })
                
                if (this.points != this.initialPoints) {
                    this.updateUserPoints(this.user, this.points)
                    console.log('update user points')
                }
            }
        },

        mounted() {
            this.getTournamentInfo(this.id)
            this.getMatches(this.id)
            if (this.user > -1) {
                this.getUserInfo(this.user)
            } else {
                this.canBet = false
            }
        }
    }
</script>