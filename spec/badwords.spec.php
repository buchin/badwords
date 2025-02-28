<?php
use Buchin\Badwords\Badwords;

describe("Badwords", function () {
    describe("isDirty()", function () {
        context("when string contains bad words", function () {
            it("returns true", function () {
                expect(Badwords::isDirty("blood sugar sex magic"))->toBe(true);
            });
        });

        context("when string does not contains bad words", function () {
            it("returns false", function () {
                expect(Badwords::isDirty("makan nasi pakai telor"))->toBe(
                    false
                );
            });
        });

        context("when string contains bad phrase", function () {
            it("returns true", function () {
                expect(
                    Badwords::isDirty("cerita panas makan nasi bakar")
                )->toBe(true);
            });
        });
    });

    describe("strip()", function () {
        context("given string contains bad words", function () {
            it("replaces vocal char in bad word with asterix", function () {
                expect(Badwords::strip("Blood sugar sex magic"))->toBe(
                    "Blood sugar s*x magic"
                );
            });
        });

        context("given string does not contains bad words", function () {
            it("does not replace anything", function () {
                expect(Badwords::strip("Blood sugar magic"))->toBe(
                    "Blood sugar magic"
                );
            });
        });
    });

    describe("negationCheck()", function() {
        context("when sentence doesn't contain bad word", function(){
            it("returns -1 when no bad word is found", function() {
                expect(
                    Badwords::negationCheck("I am Jerespy")
                )->toBe(-1);
            });
        });

        context("when sentence contains a bad word but contains a negator before the bad word", function() {
            it("return 0 when a negator appeare before bad word", function() {
                expect(
                    Badwords::negationCheck("I am an not asshole")
                )->toBe(0);
            });
        });

        context("when sentence contains a bad word", function() {
            it("return 1 when a bad word is present in the sentence", function() {
                expect(
                    Badwords::negationCheck("blood sugar sex magic")
                )->toBe(1);
            });
        });
    });

    describe("getBadword()", function (){
        context("return bad word from a sentence", function() {
            it("return bad word in sentence", function() {
                expect(
                    Badwords::getBadword("I am an not asshole")
                )->toBe("asshole");
            });
        });

        context("return -1 from a sentence, if no bad word was found", function() {
            it("return -1", function() {
                expect(
                    Badwords::getBadword("I am Jerespy")
                )->toBe(-1);
            });
        });
    });

});
