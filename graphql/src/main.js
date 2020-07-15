const fs = require('fs')
const path = require('path')
const { ApolloServer, gql } = require('apollo-server')
const schema = fs.readFileSync(path.join(__dirname, 'schema.graphql'))

const typeDefs = gql`${schema}`

const resolvers = {
  Query: {
    hello: () => {
      return Date.now()
    }
  }
}

const server = new ApolloServer({
  typeDefs,
  resolvers,
  introspection: true,
  playground: true,
})

server.listen().then(({ url }) => {
  console.log(`🚀 Server ready at ${url}`);
})
