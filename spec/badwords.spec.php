<?php 
use Buchin\Badwords\Badwords;

describe('Badwords', function ()
{
	describe('isDirty()', function(){
		context('when string contains bad words', function(){
			it('returns true', function(){
				expect(Badwords::isDirty("blood sugar sex magic"))->toBe(true);
			});
		});

		context('when string does not contains bad words', function(){
			it('returns false', function(){
				expect(Badwords::isDirty("makan nasi pakai telor"))->toBe(false);
			});
		});
	});

	describe('strip()', function(){
		context('given string contains bad words', function(){
			it('replaces vocal char in bad word with asterix', function(){
				expect(Badwords::strip('Blood sugar sex magic'))->toBe('Blood sugar s*x magic');
			});
		});

		context('given string does not contains bad words', function(){
			it('does not replace anything', function(){
				expect(Badwords::strip('Blood sugar magic'))->toBe('Blood sugar magic');
			});
		});


	});
});